<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Config\Paths;
use Dotenv\Dotenv;
use GeminiAPI\Client;
use GeminiAPI\Resources\ModelName;
use GeminiAPI\Resources\Parts\TextPart;

class ApiService
{
   public function __construct(private Database $db) {}

   public function getExpenseLimitsForApi()
   {
      $limits = $this->db->query(
         "SELECT 
                  expenses_category_assigned_to_users.id as category_id,
                  expenses_category_assigned_to_users.name as category_name,
                  expenses_category_assigned_to_users.expense_limit as limit_amount,
                  expenses_category_assigned_to_users.user_id
            FROM expenses_category_assigned_to_users
            WHERE user_id = :user_id
            AND expense_limit IS NOT NULL
            ORDER BY name ASC",
         [
            'user_id' => $_SESSION['user']
         ]
      )->findAll();

      // Formatuj dane dla lepszej czytelności
      return array_map(function ($limit) {
         return [
            'user_id' => (int) $limit['user_id'],
            'category_id' => (int) $limit['category_id'],
            'category_name' => $limit['category_name'],
            'limit_amount' => $limit['limit_amount'] ? (float) $limit['limit_amount'] : null
         ];
      }, $limits);
   }

   public function getExpenseLimitById(int $categoryId)
   {
      $firstDayOfMonth = date('Y-m-01');

      $expenseLimit = $this->db->query(
         "SELECT expense_limit FROM expenses_category_assigned_to_users 
            WHERE user_id = :user_id AND id = :category_id",
         [
            'user_id' => $_SESSION['user'],
            'category_id' => $categoryId
         ]
      )->find();

      $limitUsed = $this->db->query(
         "SELECT SUM(amount) AS limit_used FROM `expenses` 
            WHERE expenses.user_id = :user_id 
            AND expenses.expense_category_assigned_to_user_id = :category_id
            AND expenses.date_of_expense >= :firstDayOfMonth
            GROUP BY expense_category_assigned_to_user_id",
         [
            'user_id' => $_SESSION['user'],
            'category_id' => $categoryId,
            'firstDayOfMonth' => $firstDayOfMonth
         ]
      )->find();

      // Formatuj dane
      return [
         'expense_limit' => !empty($expenseLimit['expense_limit']) ? (float) $expenseLimit['expense_limit'] : 0,
         'limit_used' => !empty($limitUsed['limit_used']) ? (float) $limitUsed['limit_used'] : 0
      ];
   }

   public function generateAdviceWithAI($queryString)
   {

      $dotenv = Dotenv::createImmutable(Paths::ROOT);
      $dotenv->load();

      $systemIntructions = 'Jesteś doświadczonym doradcą finansowym, poniżej otrzymasz informację, dotyczącą przychodów, wydatków oraz okres
      czasu, w jakim wystąpiły. Wykorzystując swoją wiedzę, dokonaj analizy oraz przygotuj 3 jedno-zdaniowe porady, jak poprawić swoje zarządzanie finansami.
      Nazwy kategorii przychodów i wydatków przetłumacz na język polski. Odpowiedź przygotuj z wykorzystaniem tagów html <p>';

      // Ustaw nagłówek JSON
      header('Content-Type: application/json');

      $client = new Client($_ENV['GEMINI_API_KEY']);

      $response = $client->withV1BetaVersion()
         ->generativeModel(ModelName::GEMINI_2_5_FLASH)
         ->withSystemInstruction($systemIntructions)
         ->generateContent(
            new TextPart($queryString),
         );

      $text = $response->candidates[0]->content->parts[0]->text;

      return $text;
   }
}

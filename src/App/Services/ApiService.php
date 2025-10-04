<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

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
      $limit = $this->db->query(
         "SELECT expense_limit, SUM(amount) AS limit_used FROM `expenses` 
            INNER JOIN expenses_category_assigned_to_users ON expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id 
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

      // Zwróć null jeśli nie znaleziono
      if (!$limit) {
         return null;
      }

      // Formatuj dane
      return [
         'expense_limit' => $limit['expense_limit'] ? (float) $limit['expense_limit'] : null,
         'limit_used' => $limit['limit_used'] ? (float) $limit['limit_used'] : null
      ];
   }
}

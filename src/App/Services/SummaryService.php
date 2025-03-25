<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class SummaryService
{
      public function __construct(private Database $db) {}

      public function getUserIncomes($beginDate, $endDate)
      {
            $userIncomes = $this->db->query("SELECT name, SUM(amount) AS amountSum FROM incomes
                              INNER JOIN incomes_category_assigned_to_users 
                              ON incomes_category_assigned_to_users.id=incomes.income_category_assigned_to_user_id
                              WHERE incomes.user_id = :loggedUserId 
                              AND incomes.date_of_income BETWEEN :beginDate AND :endDate
                              GROUP BY name
                              ORDER BY amountSUM DESC", [
                  'loggedUserId' => $_SESSION['user'],
                  'beginDate' => $beginDate,
                  'endDate' => $endDate
            ])->findAll();

            return $userIncomes;
      }

      public function getUserExpenses($beginDate, $endDate)
      {
            $userExpenses = $this->db->query("SELECT name, SUM(amount) AS amountSum FROM expenses
                              INNER JOIN expenses_category_assigned_to_users 
                              ON expenses_category_assigned_to_users.id=expenses.expense_category_assigned_to_user_id
                              WHERE expenses.user_id = :loggedUserId 
                              AND expenses.date_of_expense BETWEEN :beginDate AND :endDate
                              GROUP BY name
                              ORDER BY amountSUM DESC", [
                  'loggedUserId' => $_SESSION['user'],
                  'beginDate' => $beginDate,
                  'endDate' => $endDate
            ])->findAll();

            return $userExpenses;
      }

      public function getUserName()
      {

            $userName = $this->db->query("SELECT username FROM users WHERE id = :id", [
                  'id' => $_SESSION['user']
            ])->find();

            return $userName;
      }
}

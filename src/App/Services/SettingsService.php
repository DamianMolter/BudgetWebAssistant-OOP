<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class SettingsService
{
      public function __construct(private Database $db) {}

      public function addIncomeCategory(array $formData)
      {
            $this->db->query("INSERT INTO incomes_category_assigned_to_users(user_id, name)
            VALUES (:user_id, :name)", [
                  'user_id' => $_SESSION['user'],
                  'name' => $formData['addIncomeCategory']
            ]);
      }

      public function addIncomeCategoryView(array $formData)
      {
            $this->db->query("INSERT INTO incomes_category_assigned_to_users(user_id, name)
            VALUES (:user_id, :name)", [
                  'user_id' => $_SESSION['user'],
                  'name' => $formData['addIncomeCategory']
            ]);
      }
}

<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class SettingsService
{
      public function __construct(private Database $db) {}

      public function validateNewName(string $newName): string
      {
            $newName = preg_replace('/[^A-Za-z0-9\-]/', '', $newName);
            $newName = trim($newName);
            $newName = strtoupper(substr($newName, 0, 1)) . strtolower(substr($newName, 1));

            return $newName;
      }

      public function isNameTaken(string $tableName, string $elementName)
      {
            $nameCount = $this->db->query(
                  "SELECT COUNT(*) FROM {$tableName} WHERE name = :name",
                  [
                        'name' => $elementName
                  ]
            )->count();

            if ($nameCount > 0) {
                  throw new ValidationException(['name' => ['Podana nazwa jest już zajęta.']]);
            }
      }

      public function addIncomeCategory(string $newName)
      {
            $this->db->query("INSERT INTO incomes_category_assigned_to_users(user_id, name)
            VALUES (:user_id, :name)", [
                  'user_id' => $_SESSION['user'],
                  'name' => $newName
            ]);
      }

      public function addExpenseCategory(string $newName)
      {
            $this->db->query("INSERT INTO expenses_category_assigned_to_users(user_id, name)
            VALUES (:user_id, :name)", [
                  'user_id' => $_SESSION['user'],
                  'name' => $newName
            ]);
      }

      public function addPaymentMethod(string $newName)
      {
            $this->db->query("INSERT INTO payment_methods_assigned_to_users(user_id, name)
            VALUES (:user_id, :name)", [
                  'user_id' => $_SESSION['user'],
                  'name' => $newName
            ]);
      }
}

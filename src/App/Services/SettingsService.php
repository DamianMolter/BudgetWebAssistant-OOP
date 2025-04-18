<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class SettingsService
{
      public function __construct(private Database $db) {}

      public function sanitizeNewName(string $newName): string
      {
            $newName = trim(preg_replace('/[\t\n\r\s]+/', ' ', $newName));
            return $newName;
      }

      public function isNameTaken(string $tableName, string $elementName)
      {
            $nameCount = $this->db->query(
                  "SELECT COUNT(*) FROM {$tableName} WHERE name = :name AND user_id = :user_id",
                  [
                        'name' => $elementName,
                        'user_id' => $_SESSION['user']
                  ]
            )->count();

            if ($nameCount > 0) {
                  throw new ValidationException(['newName' => ['Podana nazwa jest już zajęta.']]);
            }
      }

      public function addElement(string $tableName, string $newName)
      {
            $this->db->query("INSERT INTO {$tableName}(user_id, name)
            VALUES (:user_id, :name)", [
                  'user_id' => $_SESSION['user'],
                  'name' => $newName
            ]);
      }

      public function getUserElements(string $tableName)
      {
            $userElementNames = $this->db->query("SELECT id, name FROM {$tableName}
            WHERE user_id = :user_id", [
                  'user_id' => $_SESSION['user']
            ])->findAll();

            return $userElementNames;
      }

      public function editElement(string $tableName, string $newName, string $oldElementId)
      {

            $this->db->query("UPDATE {$tableName} SET name = :name
            WHERE user_id = :user_id AND id = :id", [
                  'user_id' => $_SESSION['user'],
                  'id' => $oldElementId,
                  'name' => $newName
            ]);
      }

      public function deleteElement(string $tableName, string $oldElementId)
      {

            $this->db->query("DELETE FROM {$tableName}
            WHERE user_id = :user_id AND id = :id", [
                  'user_id' => $_SESSION['user'],
                  'id' => $oldElementId
            ]);
      }
}

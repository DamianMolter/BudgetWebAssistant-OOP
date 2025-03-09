<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
      public function __construct(private Database $db) {}

      public function isEmailTaken(string $email)
      {
            $emailCount = $this->db->query(
                  "SELECT COUNT(*) FROM users WHERE email = :email",
                  [
                        'email' => $email
                  ]
            )->count();

            if ($emailCount > 0) {
                  throw new ValidationException(['email' => ['Podany adres email jest już zajęty.']]);
            }
      }

      public function create(array $formData)
      {
            $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

            $this->db->query(
                  "INSERT into users(username, password, email)
            VALUES(:username, :password, :email)",
                  [
                        'username' => $formData['name'],
                        'password' => $password,
                        'email' => $formData['email']
                  ]
            );

            $newUserId = $this->db->query("SELECT id FROM users where email = :email", [
                  'email' => $formData['email']
            ])->find();

            $incomeCategories = $this->db->query("SELECT * FROM incomes_category_default", [])->findAll();
            $expenseCategories = $this->db->query("SELECT * FROM expenses_category_default", [])->findAll();

            foreach ($incomeCategories as $incomeCategory) {
                  $this->db->query(
                        "INSERT into incomes_category_assigned_to_users(user_id, name)
                  VALUES(:user_id, :name)",
                        [
                              'user_id' => $newUserId['id'],
                              'name' => $incomeCategory['name']
                        ]
                  );
            }

            foreach ($expenseCategories as $expenseCategory) {
                  $this->db->query(
                        "INSERT into expenses_category_assigned_to_users(user_id, name)
                  VALUES(:user_id, :name)",
                        [
                              'user_id' => $newUserId['id'],
                              'name' => $expenseCategory['name']
                        ]
                  );
            }

            session_regenerate_id();
            $_SESSION['registerSuccessfull'] = true;
      }

      public function login(array $formData)
      {
            $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
                  'email' => $formData['email']
            ])->find();

            $passwordMatch = password_verify(
                  $formData['password'],
                  $user['password'] ?? ''
            );

            if (!$user || !$passwordMatch) {
                  throw new ValidationException(['password' => ['Invalid credentials.']]);
            }

            session_regenerate_id();

            $_SESSION['user'] = $user['id'];
      }

      public function logout()
      {
            //unset($_SESSION['user']);
            session_destroy();

            //session_regenerate_id();
            $params = session_get_cookie_params();
            setcookie(
                  'PHPSESSID',
                  '',
                  time() - 3600,
                  $params['path'],
                  $params['domain'],
                  $params['secure'],
                  $params['httponly']
            );
      }
}

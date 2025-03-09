<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class ExpenseService
{
      public function __construct(private Database $db) {}

      public function create(array $formData)
      {

            $this->db->query(
                  "INSERT INTO expenses(user_id, 
                  expense_category_assigned_to_user_id, 
                  payment_method_assigned_to_user_id, 
                  amount, 
                  date_of_expense, 
                  expense_comment)
            VALUES(:user_id, 
                  :expense_category_assigned_to_user_id,
                  :payment_method_assigned_to_user_id, 
                  :amount, 
                  :date_of_expense, 
                  :expense_comment)",

                  [
                        'user_id' => $_SESSION['user'],
                        'expense_category_assigned_to_user_id' => $formData['expenseCategory'],
                        'payment_method_assigned_to_user_id' => $formData['paymentMethod'],
                        'amount' => $formData['amount'],
                        'date_of_expense' => $formData['date'],
                        'expense_comment' => $formData['expenseComment']
                  ]
            );

            $_SESSION['success'] = true;
      }

      public function getUserTransactions(int $length, int $offset)
      {
            $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
            $params = [
                  'user_id' => $_SESSION['user'],
                  'description' => "%{$searchTerm}%"
            ];

            $transactions = $this->db->query(
                  "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formated_date 
                  FROM transactions 
                  WHERE user_id = :user_id
                  AND description LIKE :description
                  LIMIT {$length} OFFSET {$offset}",
                  $params
            )->findAll();

            $transactions = array_map(function (array $transaction) {
                  $transaction['receipts'] = $this->db->query(
                        "SELECT * FROM receipts WHERE transaction_id = :transaction_id",
                        [
                              'transaction_id' => $transaction['id']
                        ]
                  )->findAll();

                  return $transaction;
            }, $transactions);


            $transactionCount = $this->db->query(
                  "SELECT COUNT(*), DATE_FORMAT(date, '%Y-%m-%d') as formated_date 
                  FROM transactions 
                  WHERE user_id = :user_id
                  AND description LIKE :description",
                  $params
            )->count();


            return [$transactions, $transactionCount];
      }

      public function getUserTransaction(string $id)
      {
            return $this->db->query(
                  "SELECT *, DATE_FORMAT(date, '%Y-%m-%d') as formatted_date 
                  FROM transactions
                  WHERE id = :id AND user_id = :user_id",
                  [
                        'id' => $id,
                        'user_id' => $_SESSION['user']
                  ]
            )->find();
      }

      public function update(array $formData, int $id)
      {

            $formattedDate = "{$formData['date']} 00:00:00";

            $this->db->query(
                  "UPDATE transactions
                  SET description = :description,
                  amount = :amount,
                  date = :date
                  WHERE
                  id = :id AND
                  user_id = :user_id",
                  [
                        'description' => $formData['description'],
                        'amount' => $formData['amount'],
                        'date' => $formattedDate,
                        'id' => $id,
                        'user_id' => $_SESSION['user']
                  ]
            );
      }

      public function delete(int $id)
      {
            $this->db->query(
                  "
            DELETE from transactions WHERE id = :id AND user_id = :user_id",
                  [
                        'id' => $id,
                        'user_id' => $_SESSION['user']
                  ]
            );
      }

      public function getUserExpenseCategories()
      {
            $userExpenseCategories = $this->db->query("SELECT id, name FROM expenses_category_assigned_to_users 
            WHERE user_id = :user_id", [
                  'user_id' => $_SESSION['user']
            ])->findAll();

            return $userExpenseCategories;
      }

      public function getUserPaymentMethods()
      {
            $userPaymentMethods = $this->db->query("SELECT id, name FROM payment_methods_assigned_to_users 
            WHERE user_id = :user_id", [
                  'user_id' => $_SESSION['user']
            ])->findAll();

            return $userPaymentMethods;
      }
}

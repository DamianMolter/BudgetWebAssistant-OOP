<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, IncomeService};
use Framework\Validator;

class ExpenseController
{
      public function __construct(
            private TemplateEngine $view,
            private ValidatorService $validatorService,
            private IncomeService $expenseService
      ) {}

      public function createView()
      {
            echo $this->view->render("transactions/expense.php");
      }

      public function create()
      {
            $this->validatorService->validateTransaction($_POST);

            $this->expenseService->create($_POST);

            redirectTo('/');
      }

      public function editView(array $params)
      {
            $transaction = $this->expenseService->getUserTransaction(
                  $params['transaction']
            );

            if (!$transaction) {
                  redirectTo('/');
            }

            echo $this->view->render('transactions/edit.php', [
                  'transaction' => $transaction
            ]);
      }

      public function edit(array $params)
      {
            $transaction = $this->expenseService->getUserTransaction(
                  $params['transaction']
            );

            if (!$transaction) {
                  redirectTo('/');
            }

            $this->validatorService->validateTransaction($_POST);

            $this->expenseService->update($_POST, $transaction['id']);

            redirectTo($_SERVER['HTTP_REFERER']);
      }

      public function delete(array $params)
      {
            $this->expenseService->delete((int) $params['transaction']);

            redirectTo('/');
      }
}

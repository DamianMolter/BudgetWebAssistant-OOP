<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, IncomeService};
use Framework\Validator;

class IncomeController
{
      public function __construct(
            private TemplateEngine $view,
            private ValidatorService $validatorService,
            private IncomeService $incomeService
      ) {}

      public function createView()
      {
            $userIncomeCategories = $this->incomeService->getUserIncomeCategories();

            echo $this->view->render("transactions/income.php", [
                  'userIncomeCategories' => $userIncomeCategories
            ]);
      }

      public function create()
      {
            $this->validatorService->validateTransaction($_POST);

            $this->incomeService->create($_POST);

            redirectTo('/');
      }

      public function editView(array $params)
      {
            $transaction = $this->incomeService->getUserTransaction(
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
            $transaction = $this->incomeService->getUserTransaction(
                  $params['transaction']
            );

            if (!$transaction) {
                  redirectTo('/');
            }

            $this->validatorService->validateTransaction($_POST);

            $this->incomeService->update($_POST, $transaction['id']);

            redirectTo($_SERVER['HTTP_REFERER']);
      }

      public function delete(array $params)
      {
            $this->incomeService->delete((int) $params['transaction']);

            redirectTo('/');
      }
}

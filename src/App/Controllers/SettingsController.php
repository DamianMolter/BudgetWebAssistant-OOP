<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\SettingsService as ServicesSettingsService;
use App\Services\ValidatorService as ServicesValidatorService;
use Framework\TemplateEngine;
use Services\{SettingsService, ValidatorService};

class SettingsController
{
      public function __construct(
            private TemplateEngine $view,
            private ServicesSettingsService $settingsService,
            private ServicesValidatorService $validatorService
      ) {}

      public function settingsView()
      {
            echo $this->view->render('settings.php', [
                  'title' => 'Ustawienia'
            ]);
      }

      public function addIncomeCategoryView()
      {
            $elementName = 'kategorię przychodu';

            echo $this->view->render('settings/add-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName
            ]);
      }

      public function addIncomeCategory()
      {
            $tableName = 'incomes_category_assigned_to_users';

            $validatedName = $this->settingsService->validateNewName($_POST['newName']);

            $this->settingsService->isNameTaken($tableName, $validatedName);

            $this->settingsService->addIncomeCategory($validatedName);

            $_SESSION['success'] = true;
            redirectTo('/settings/add-income-category');
      }

      public function addExpenseCategoryView()
      {
            $elementName = 'kategorię wydatku';
            echo $this->view->render('settings/add-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName
            ]);
      }

      public function addExpenseCategory()
      {
            $tableName = 'expenses_category_assigned_to_users';

            $validatedName = $this->settingsService->validateNewName($_POST['newName']);

            $this->settingsService->isNameTaken($tableName, $validatedName);

            $this->settingsService->addExpenseCategory($validatedName);

            $_SESSION['success'] = true;
            redirectTo('/settings/add-expense-category');
      }

      public function addPaymentMethodView()
      {
            $elementName = 'metodę płatności';
            echo $this->view->render('settings/add-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName
            ]);
      }

      public function addPaymentMethod()
      {
            $tableName = 'payment_methods_assigned_to_users';

            $validatedName = $this->settingsService->validateNewName($_POST['newName']);

            $this->settingsService->isNameTaken($tableName, $validatedName);

            $this->settingsService->addPaymentMethod($validatedName);

            $_SESSION['success'] = true;
            redirectTo('/settings/add-payment-method');
      }
}

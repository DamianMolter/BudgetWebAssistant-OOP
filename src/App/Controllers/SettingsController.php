<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{SettingsService, ValidatorService};
use Framework\TemplateEngine;

class SettingsController
{
      public function __construct(
            private TemplateEngine $view,
            private SettingsService $settingsService,
            private ValidatorService $validatorService
      ) {}

      private function checkAndAdd(string $tableName, array $formData)
      {
            $this->validatorService->validateElement($formData);

            $sanitizedName = $this->settingsService->sanitizeNewName($formData['newName']);

            $this->settingsService->isNameTaken($tableName, $sanitizedName);

            $this->settingsService->addElement($tableName, $sanitizedName);

            $_SESSION['success'] = true;
      }

      private function checkAndEdit(array $formData, string $tableName)
      {
            $this->validatorService->validateElement($formData);

            $sanitizedName = $this->settingsService->sanitizeNewName($formData['newName']);

            $this->settingsService->isNameTaken($tableName, $sanitizedName);

            $this->settingsService->editElement($tableName, $sanitizedName, $formData['oldElementId']);

            $_SESSION['success'] = true;
      }

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

            $this->checkAndAdd($tableName, $_POST);

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

            $this->checkAndAdd($tableName, $_POST);

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

            $this->checkAndAdd($tableName, $_POST);

            redirectTo('/settings/add-payment-method');
      }

      public function editIncomeCategoryView()
      {
            $elementName = 'kategorię przychodu';
            $userElementNames = $this->settingsService->getUserElements('incomes_category_assigned_to_users');

            echo $this->view->render('settings/edit-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName,
                  'userElementNames' => $userElementNames
            ]);
      }

      public function editIncomeCategory()
      {
            $tableName = 'incomes_category_assigned_to_users';

            $this->checkAndEdit($_POST, $tableName);

            redirectTo('/settings/edit-income-category');
      }

      public function editExpenseCategoryView()
      {
            $elementName = 'kategorię wydatku';
            $userElementNames = $this->settingsService->getUserElements('expenses_category_assigned_to_users');

            echo $this->view->render('settings/edit-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName,
                  'userElementNames' => $userElementNames
            ]);
      }

      public function editExpenseCategory()
      {
            $tableName = 'expenses_category_assigned_to_users';

            $this->checkAndEdit($_POST, $tableName);

            redirectTo('/settings/edit-expense-category');
      }

      public function editPaymentMethodView()
      {
            $elementName = 'metodę płatności';
            $userElementNames = $this->settingsService->getUserElements('payment_methods_assigned_to_users');

            echo $this->view->render('settings/edit-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName,
                  'userElementNames' => $userElementNames
            ]);
      }

      public function editPaymentMethod()
      {
            $tableName = 'payment_methods_assigned_to_users';

            $this->checkAndEdit($_POST, $tableName);

            redirectTo('/settings/edit-payment-method');
      }

      public function deleteIncomeCategoryView()
      {
            $elementName = 'kategorię przychodu';
            $userElementNames = $this->settingsService->getUserElements('incomes_category_assigned_to_users');

            echo $this->view->render('settings/delete-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName,
                  'userElementNames' => $userElementNames
            ]);
      }

      public function deleteIncomeCategory()
      {
            $tableName = 'incomes_category_assigned_to_users';

            $this->settingsService->deleteElement($tableName, $_POST['oldElementId']);

            $_SESSION['success'] = true;
            redirectTo('/settings/delete-income-category');
      }

      public function deleteExpenseCategoryView()
      {
            $elementName = 'kategorię wydatku';
            $userElementNames = $this->settingsService->getUserElements('expenses_category_assigned_to_users');

            echo $this->view->render('settings/delete-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName,
                  'userElementNames' => $userElementNames
            ]);
      }

      public function deleteExpenseCategory()
      {
            $tableName = 'expenses_category_assigned_to_users';

            $this->settingsService->deleteElement($tableName, $_POST['oldElementId']);

            $_SESSION['success'] = true;
            redirectTo('/settings/delete-expense-category');
      }

      public function deletePaymentMethodView()
      {
            $elementName = 'formę płatności';
            $userElementNames = $this->settingsService->getUserElements('payment_methods_assigned_to_users');

            echo $this->view->render('settings/delete-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName,
                  'userElementNames' => $userElementNames
            ]);
      }

      public function deletePaymentMethod()
      {
            $tableName = 'payment_methods_assigned_to_users';

            $this->settingsService->deleteElement($tableName, $_POST['oldElementId']);

            $_SESSION['success'] = true;
            redirectTo('/settings/delete-payment-method');
      }
}

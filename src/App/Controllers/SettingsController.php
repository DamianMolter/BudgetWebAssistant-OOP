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

      public function addIncomeCategory()
      {
            $this->settingsService->addIncomeCategory($_POST);
      }

      public function addIncomeCategoryView()
      {
            $elementName = 'kategorię przychodu';

            echo $this->view->render('settings/add-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName
            ]);
      }

      public function addExpenseCategoryView()
      {
            $elementName = 'kategorię wydatku';
            echo $this->view->render('settings/add-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName
            ]);
      }

      public function addPaymentMethodView()
      {
            $elementName = 'metodę płatności';
            echo $this->view->render('settings/add-element.php', [
                  'title' => 'Ustawienia',
                  'elementName' => $elementName
            ]);
      }
}

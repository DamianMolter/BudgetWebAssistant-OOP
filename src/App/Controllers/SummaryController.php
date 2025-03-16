<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\SummaryService;

class SummaryController
{
      public function __construct(
            private TemplateEngine $view,
            private SummaryService $summaryService
      ) {}

      public function summaryViewCurrentMonth()
      {
            $beginDate = date('Y-m-01');
            $endDate = date('Y-m-d');

            $userIncomes = $this->summaryService->getUserIncomes($beginDate, $endDate);
            $userExpenses = $this->summaryService->getUserExpenses($beginDate, $endDate);

            $chosenPeriod = 'bieżący miesiąc';

            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy',
                  'userIncomes' => $userIncomes,
                  'userExpenses' => $userExpenses,
                  'chosenPeriod' => $chosenPeriod
            ]);
      }

      public function summaryViewPreviousMonth()
      {
            $beginDate = date('Y-m-01', strtotime('-1 month'));
            $endDate = date('Y-m-t', strtotime('-1 month'));

            $userIncomes = $this->summaryService->getUserIncomes($beginDate, $endDate);
            $userExpenses = $this->summaryService->getUserExpenses($beginDate, $endDate);

            $chosenPeriod = 'poprzedni miesiąc.';

            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy',
                  'userIncomes' => $userIncomes,
                  'userExpenses' => $userExpenses,
                  'chosenPeriod' => $chosenPeriod
            ]);
      }

      public function summaryViewCurrentYear()
      {
            $beginDate = date('Y-01-01');
            $endDate = date('Y-12-31');

            $userIncomes = $this->summaryService->getUserIncomes($beginDate, $endDate);
            $userExpenses = $this->summaryService->getUserExpenses($beginDate, $endDate);

            $chosenPeriod = 'bieżący rok.';

            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy',
                  'userIncomes' => $userIncomes,
                  'userExpenses' => $userExpenses,
                  'chosenPeriod' => $chosenPeriod
            ]);
      }

      public function summaryCustomPeriod()
      {
            $_SESSION['beginDate'] = $_POST['beginDate'];
            $_SESSION['endDate'] = $_POST['endDate'];
            redirectTo('/summary/custom-period');
      }

      public function summaryViewCustomPeriod()
      {
            $beginDate = $_SESSION['beginDate'];
            $endDate = $_SESSION['endDate'];

            $userIncomes = $this->summaryService->getUserIncomes($beginDate, $endDate);
            $userExpenses = $this->summaryService->getUserExpenses($beginDate, $endDate);

            $chosenPeriod = " od {$beginDate} do {$endDate}.";

            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy',
                  'userIncomes' => $userIncomes,
                  'userExpenses' => $userExpenses,
                  'chosenPeriod' => $chosenPeriod
            ]);
      }
}

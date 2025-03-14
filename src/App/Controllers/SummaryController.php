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

            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy',
                  'userIncomes' => $userIncomes,
                  'userExpenses' => $userExpenses
            ]);
      }

      public function summaryViewPreviousMonth()
      {
            $beginDate = date('Y-m-01', strtotime('-1 month'));
            $endDate = date('Y-m-t', strtotime('-1 month'));

            $userIncomes = $this->summaryService->getUserIncomes($beginDate, $endDate);
            $userExpenses = $this->summaryService->getUserExpenses($beginDate, $endDate);

            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy',
                  'userIncomes' => $userIncomes,
                  'userExpenses' => $userExpenses
            ]);
      }

      public function summaryViewCurrentYear()
      {
            $beginDate = date('Y-01-01');
            $endDate = date('Y-12-31');

            $userIncomes = $this->summaryService->getUserIncomes($beginDate, $endDate);
            $userExpenses = $this->summaryService->getUserExpenses($beginDate, $endDate);

            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy',
                  'userIncomes' => $userIncomes,
                  'userExpenses' => $userExpenses
            ]);
      }
}

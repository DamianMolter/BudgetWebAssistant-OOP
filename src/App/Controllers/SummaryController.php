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

      public function summaryView()
      {
            $currentMonthIncomes = $this->summaryService->getCurrentMonthIncomes();
            $currentMonthExpenses = $this->summaryService->getCurrentMonthExpenses();

            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy',
                  'currentMonthIncomes' => $currentMonthIncomes,
                  'currentMonthExpenses' => $currentMonthExpenses
            ]);
      }
}

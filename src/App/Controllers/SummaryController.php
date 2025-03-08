<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class SummaryController
{
      public function __construct(private TemplateEngine $view) {}

      public function summary()
      {
            echo $this->view->render('summary.php', [
                  'title' => 'Twój zaufany asystent budżetowy'
            ]);
      }
}

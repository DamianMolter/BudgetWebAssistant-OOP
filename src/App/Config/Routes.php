<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
      WelcomeController,
      SummaryController,
      HomeController,
      AboutController,
      AuthController,
      IncomeController,
      ExpenseController,
      TransactionController,
      ReceiptController,
      ErrorController
};

use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{
      $app->get('/', [WelcomeController::class, 'welcome'])->add(GuestOnlyMiddleware::class);
      $app->get('/summary', [SummaryController::class, 'summaryViewCurrentMonth'])->add(AuthRequiredMiddleware::class);
      $app->get('/summary/previous-month', [SummaryController::class, 'summaryViewPreviousMonth'])->add(AuthRequiredMiddleware::class);
      $app->get('/summary/current-year', [SummaryController::class, 'summaryViewCurrentYear'])->add(AuthRequiredMiddleware::class);
      $app->get('/about', [AboutController::class, 'about']);
      $app->get('/register', [AuthController::class, 'registerView'])->add(GuestOnlyMiddleware::class);
      $app->post('/register', [AuthController::class, 'register'])->add(GuestOnlyMiddleware::class);
      $app->get('/login', [AuthController::class, 'loginView'])->add(GuestOnlyMiddleware::class);
      $app->post('/login', [AuthController::class, 'login'])->add(GuestOnlyMiddleware::class);
      $app->get('/logout', [AuthController::class, 'logout'])->add(AuthRequiredMiddleware::class);
      $app->get('/income', [IncomeController::class, 'createView'])->add(AuthRequiredMiddleware::class);
      $app->post('/income', [IncomeController::class, 'create'])->add(AuthRequiredMiddleware::class);
      $app->get('/expense', [ExpenseController::class, 'createView'])->add(AuthRequiredMiddleware::class);
      $app->post('/expense', [ExpenseController::class, 'create'])->add(AuthRequiredMiddleware::class);
      $app->get('/transaction/{transaction}/', [TransactionController::class, 'editView'])->add(AuthRequiredMiddleware::class);
      $app->post('/transaction/{transaction}/', [TransactionController::class, 'edit'])->add(AuthRequiredMiddleware::class);
      $app->delete('/transaction/{transaction}/', [TransactionController::class, 'delete'])->add(AuthRequiredMiddleware::class);
      $app->get('/transaction/{transaction}/receipt', [ReceiptController::class, 'uploadView'])->add(AuthRequiredMiddleware::class);
      $app->post('/transaction/{transaction}/receipt', [ReceiptController::class, 'upload'])->add(AuthRequiredMiddleware::class);
      $app->get('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'download'])->add(AuthRequiredMiddleware::class);
      $app->delete('/transaction/{transaction}/receipt/{receipt}', [ReceiptController::class, 'delete'])->add(AuthRequiredMiddleware::class);
      $app->setErrorHandler([ErrorController::class, 'notFound']);
}

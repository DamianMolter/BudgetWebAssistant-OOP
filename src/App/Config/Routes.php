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
      ErrorController,
      SettingsController,
      ApiController
};

use App\Middleware\{AuthRequiredMiddleware, GuestOnlyMiddleware};

function registerRoutes(App $app)
{
      $app->get('/', [WelcomeController::class, 'welcome'])->add(GuestOnlyMiddleware::class);
      $app->get('/summary', [SummaryController::class, 'summaryViewCurrentMonth'])->add(AuthRequiredMiddleware::class);
      $app->post('/summary', [SummaryController::class, 'summaryCustomPeriod'])->add(AuthRequiredMiddleware::class);
      $app->post('/summary/previous-month', [SummaryController::class, 'summaryCustomPeriod'])->add(AuthRequiredMiddleware::class);
      $app->post('/summary/current-year', [SummaryController::class, 'summaryCustomPeriod'])->add(AuthRequiredMiddleware::class);
      $app->post('/summary/custom-period', [SummaryController::class, 'summaryCustomPeriod'])->add(AuthRequiredMiddleware::class);
      $app->get('/summary/previous-month', [SummaryController::class, 'summaryViewPreviousMonth'])->add(AuthRequiredMiddleware::class);
      $app->get('/summary/current-year', [SummaryController::class, 'summaryViewCurrentYear'])->add(AuthRequiredMiddleware::class);
      $app->get('/summary/custom-period', [SummaryController::class, 'summaryViewCustomPeriod'])->add(AuthRequiredMiddleware::class);
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
      $app->get('/settings', [SettingsController::class, 'settingsView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/add-income-category', [SettingsController::class, 'addIncomeCategoryView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/edit-income-category', [SettingsController::class, 'editIncomeCategoryView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/delete-income-category', [SettingsController::class, 'deleteIncomeCategoryView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/add-expense-category', [SettingsController::class, 'addExpenseCategoryView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/edit-expense-category', [SettingsController::class, 'editExpenseCategoryView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/delete-expense-category', [SettingsController::class, 'deleteExpenseCategoryView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/add-payment-method', [SettingsController::class, 'addPaymentMethodView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/edit-payment-method', [SettingsController::class, 'editPaymentMethodView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/delete-payment-method', [SettingsController::class, 'deletePaymentMethodView'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/set-expense-limit', [SettingsController::class, 'setExpenseLimitView'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/set-expense-limit', [SettingsController::class, 'setExpenseLimit'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/add-income-category', [SettingsController::class, 'addIncomeCategory'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/edit-income-category', [SettingsController::class, 'editIncomeCategory'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/delete-income-category', [SettingsController::class, 'deleteIncomeCategory'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/add-expense-category', [SettingsController::class, 'addExpenseCategory'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/edit-expense-category', [SettingsController::class, 'editExpenseCategory'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/delete-expense-category', [SettingsController::class, 'deleteExpenseCategory'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/add-payment-method', [SettingsController::class, 'addPaymentMethod'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/edit-payment-method', [SettingsController::class, 'editPaymentMethod'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/delete-payment-method', [SettingsController::class, 'deletePaymentMethod'])->add(AuthRequiredMiddleware::class);
      $app->get('/settings/user-account-settings', [AuthController::class, 'userAccountSettingsView'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings/user-account-settings', [AuthController::class, 'userAccountSettings'])->add(AuthRequiredMiddleware::class);
      $app->post('/settings', [AuthController::class, 'deleteUserAccount'])->add(AuthRequiredMiddleware::class);
      $app->setErrorHandler([ErrorController::class, 'notFound']);
      $app->get('/api/expense-limits', [ApiController::class, 'getExpenseLimits'])->add(AuthRequiredMiddleware::class);
      $app->get('/api/expense-limits/{id}', [ApiController::class, 'getExpenseLimitById'])->add(AuthRequiredMiddleware::class);
      $app->get('/api/advise', [ApiController::class, 'getFinancialAdvise'])->add(AuthRequiredMiddleware::class);
}

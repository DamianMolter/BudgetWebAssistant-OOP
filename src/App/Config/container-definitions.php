<?php

declare(strict_types=1);

use Framework\{TemplateEngine, Database, Container};
use App\Config\Paths;
use App\Services\{ValidatorService, UserService, ReceiptService, IncomeService, ExpenseService, SummaryService};

return [
      TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW),
      ValidatorService::class => fn() => new ValidatorService(),
      Database::class => fn() => new Database($_ENV['DB_DRIVER'], [
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'dbname' => $_ENV['DB_NAME']
      ], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']),
      UserService::class => function (Container $container) {
            $db = $container->get(Database::class);

            return new UserService($db);
      },

      IncomeService::class => function (Container $container) {
            $db = $container->get(Database::class);

            return new IncomeService($db);
      },

      ExpenseService::class => function (Container $container) {
            $db = $container->get(Database::class);

            return new ExpenseService($db);
      },

      SummaryService::class => function (Container $container) {
            $db = $container->get(Database::class);

            return new SummaryService($db);
      },

      ReceiptService::class => function (Container $container) {
            $db = $container->get(Database::class);

            return new ReceiptService($db);
      }
];

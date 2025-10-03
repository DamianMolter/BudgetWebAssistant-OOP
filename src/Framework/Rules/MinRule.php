<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class MinRule implements RuleInterface
{
      public function validate(array $data, string $field, array $params): bool
      {
            return $data['amount'] >= 0;
      }
      public function getMessage(array $data, string $field, array $params): string
      {
            return "Wpisana wartość nie może być mniejsza od {$params[0]}.";
      }
}

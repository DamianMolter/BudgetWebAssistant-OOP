<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class NameRule implements RuleInterface
{
      public function validate(array $data, string $field, array $params): bool
      {
            return (bool) (strlen($data[$field]) >= 3 && ctype_alpha($data[$field]));
      }
      public function getMessage(array $data, string $field, array $params): string
      {
            return "Podane imię musi składać się wyłącznie z liter i mieć długość co najmniej 3 znaków.";
      }
}

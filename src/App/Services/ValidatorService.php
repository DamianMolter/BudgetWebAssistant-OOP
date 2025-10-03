<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
      RequireRule,
      EmailRule,
      NameRule,
      MinRule,
      InRule,
      UrlRule,
      MatchRule,
      LengthMaxRule,
      NumericRule,
      DateFormatRule
};

class ValidatorService
{
      private Validator $validator;

      public function __construct()
      {
            $this->validator = new Validator();

            $this->validator->add('required', new RequireRule());
            $this->validator->add('email', new EmailRule());
            $this->validator->add('name', new NameRule());
            $this->validator->add('min', new MinRule());
            $this->validator->add('in', new InRule());
            $this->validator->add('url', new UrlRule());
            $this->validator->add('match', new MatchRule());
            $this->validator->add('lengthMax', new LengthMaxRule());
            $this->validator->add('numeric', new NumericRule());
            $this->validator->add('dateFormat', new DateFormatRule());
      }

      public function validateRegister(array $formData)
      {
            $this->validator->validate($formData, [
                  'name' => ['required', 'name'],
                  'email' => ['required', 'email'],
                  //'age' => ['required', 'min:18'],
                  //'country' => ['required', 'in:USA,Canada,Mexico'],
                  //'socialMediaURL' => ['required', 'url'],
                  'password' => ['required'],
                  'confirmPassword' => ['required', 'match:password']
                  //'tos' => ['required']
            ]);
      }

      public function validateLogin(array $formData)
      {
            $this->validator->validate($formData, [
                  'email' => ['required', 'email'],
                  'password' => ['required']
            ]);
      }

      public function validateTransaction(array $formData)
      {
            $this->validator->validate($formData, [
                  'amount' => ['required', 'numeric'],
                  'date' => ['required', 'dateFormat:Y-m-d']
            ]);
      }

      public function validateElement(array $formData)
      {
            $this->validator->validate($formData, [
                  'newName' => ['required']
            ]);
      }

      public function validateUserAccountSettings(array $formData)
      {

            $this->validator->validate($formData, [
                  'name' => ['required', 'name'],
                  'email' => ['required', 'email'],
                  'confirmPassword' => ['match:password']
            ]);
      }

      public function validateLimit(array $formData)
      {
            $this->validator->validate($formData, [
                  'amount' => ['min:0']
            ]);
      }
}

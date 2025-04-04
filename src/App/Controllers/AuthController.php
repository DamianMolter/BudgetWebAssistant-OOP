<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class AuthController
{
      public function __construct(
            private TemplateEngine $view,
            private ValidatorService $validatorService,
            private UserService $userService
      ) {}

      public function home() {}

      public function registerView()
      {
            echo $this->view->render('register.php');
      }

      public function register()
      {
            $this->validatorService->validateRegister($_POST);

            $this->userService->isEmailTaken($_POST['email']);

            $this->userService->create($_POST);

            redirectTo('/');
      }

      public function loginView()
      {
            echo $this->view->render('login.php');
      }

      public function login()
      {
            $this->validatorService->validateLogin($_POST);

            $this->userService->login($_POST);

            redirectTo(('/'));
      }

      public function logout()
      {
            $this->userService->logout();
            redirectTo("/");
      }

      public function userAccountSettingsView()
      {
            $userData = $this->userService->getUserData();

            echo $this->view->render('settings/user-account-settings.php', [
                  'userData' => $userData
            ]);
      }

      public function userAccountSettings()
      {
            $this->validatorService->validateUserAccountSettings($_POST);

            $this->userService->isEmailTakenByOtherUser($_POST['email']);

            $this->userService->editUserData($_POST);

            $_SESSION['success'] = true;

            redirectTo("/settings/user-account-settings");
      }

      public function deleteUserAccount()
      {
            $this->userService->deleteUserAccount($_POST);

            $this->userService->logout();

            redirectTo("/");
      }
}

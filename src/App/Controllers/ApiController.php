<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\ApiService;

class ApiController
{
   public function __construct(private ApiService $apiService) {}

   public function getExpenseLimits()
   {
      // Sprawdź czy użytkownik jest zalogowany
      if (empty($_SESSION['user'])) {
         http_response_code(401);
         header('Content-Type: application/json');
         echo json_encode([
            'success' => false,
            'message' => 'Unauthorized'
         ]);
         return;
      }

      // Pobierz limity z serwisu
      $limits = $this->apiService->getExpenseLimitsForApi();

      // Zwróć jako JSON
      header('Content-Type: application/json');
      echo json_encode([
         'success' => true,
         'data' => $limits
      ]);
   }

   public function getExpenseLimitById(array $params)
   {
      // Sprawdź czy użytkownik jest zalogowany
      if (empty($_SESSION['user'])) {
         http_response_code(401);
         header('Content-Type: application/json');
         echo json_encode([
            'success' => false,
            'message' => 'Unauthorized'
         ]);
         return;
      }

      // Walidacja ID
      $categoryId = $params['id'] ?? null;
      if (!$categoryId || !is_numeric($categoryId)) {
         http_response_code(400);
         header('Content-Type: application/json');
         echo json_encode([
            'success' => false,
            'message' => 'Invalid category ID'
         ]);
         return;
      }

      // Pobierz limit dla konkretnej kategorii
      $limit = $this->apiService->getExpenseLimitById((int) $categoryId);

      // Zwróć jako JSON
      header('Content-Type: application/json');
      echo json_encode(
         $limit
      );
   }

   public function getFinancialAdvise() {}
}

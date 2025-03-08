<?php

namespace App\Infrastructure\API\v1\Controllers;

use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class HealthCheckController
{
    #[Route('/api/v1/health-check', name: 'health_check', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'OK'], JsonResponse::HTTP_OK);
    }
}

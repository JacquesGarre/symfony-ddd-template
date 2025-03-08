<?php

namespace App\Infrastructure\API\v1\Controllers;

use Doctrine\DBAL\Connection;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class DatabaseHealthCheckController
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    #[Route('/api/v1/db-health-check', name: 'db_health_check', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        try {
            $this->connection->executeQuery('SELECT 1');
            return new JsonResponse(
                ['status' => 'OK'],
                JsonResponse::HTTP_OK
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                ['status' => 'ERROR', 'message' => $e->getMessage()],
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}

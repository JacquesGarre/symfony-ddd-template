<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\Exception\ValidationFailedException;

class ExceptionListener
{
    /**
     * @var array<class-string<\Throwable>, int>
     */
    private array $exceptionMap = [
           ValidationFailedException::class => JsonResponse::HTTP_BAD_REQUEST,
    ];

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $statusCode = JsonResponse::HTTP_BAD_REQUEST;
        $message = 'Bad request';
        foreach ($this->exceptionMap as $exceptionClass => $code) {
            if ($exception instanceof $exceptionClass) {
                $message = $exception instanceof ValidationFailedException
                    ? $this->formatValidationMessages($exception)
                    : $exception->getMessage();
                $statusCode = $code;
                break;
            }
        }
        $response = new JsonResponse(['error' => $message], $statusCode);
        $event->setResponse($response);
    }

    private function formatValidationMessages(ValidationFailedException $exception): string
    {
        $violations = $exception->getViolations();
        $messages = [];
        foreach ($violations as $violation) {
            $messages[] = $violation->getMessage();
        }
        return implode(', ', $messages);
    }
}

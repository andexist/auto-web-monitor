<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Exception\MissingResourceException;
use App\Exception\RickAndMorty\RickAndMortyNoNextPageException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HandlerFailedException) {
            $wrappedException = $exception->getPrevious();
            $this->handleCustomException($event, $wrappedException);
        }

        $this->handleCustomException($event, $exception);
    }

    private function handleCustomException($event, $exception)
    {
        $responseMapping = [
            MissingResourceException::class => [
                'status' => Response::HTTP_NOT_FOUND,
                'type' => 'MissingResourceException',
            ],
            RickAndMortyNoNextPageException::class => [
                'status' => Response::HTTP_NOT_FOUND,
                'type' => 'RickAndMortyNoNextPageException',
            ],
            InvalidUrlException::class => [
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'type' => 'InvalidUrlException',
            ],
        ];

        foreach ($responseMapping as $exceptionType => $responseInfo) {
            if ($exception instanceof $exceptionType) {
                $response = new JsonResponse([
                    'status' => $responseInfo['status'],
                    'error' => [
                        'code' => $responseInfo['status'],
                        'type' => $responseInfo['type'],
                        'message' => $exception->getMessage(),
                    ],
                ], $responseInfo['status']);

                $event->setResponse($response);
                break;
            }
        }
    }
}

<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class UnprocessableContentListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if($exception instanceof HttpExceptionInterface && $exception->getStatusCode() ===422){
            $response = new JsonResponse(["mensagem" => $exception->getMessage()],422,$exception->getHeaders());
            $event->setResponse($response);
        }
    }
}
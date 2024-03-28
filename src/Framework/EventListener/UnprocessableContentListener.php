<?php

namespace App\Framework\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class UnprocessableContentListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if($exception instanceof HttpExceptionInterface){
            $response = new JsonResponse(["mensagem" => $exception->getMessage()],$exception->getStatusCode(),$exception->getHeaders());
            $event->setResponse($response);
        }
    }
}
<?php

declare(strict_types = 1);

namespace App\Framework\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationFailureListener
{
    public function __invoke(AuthenticationFailureEvent $event): void
    {
        $response =  new JsonResponse(["mensagem" => "Credenciais Incorretas"],401);
        $event->setResponse($response);
    }
}
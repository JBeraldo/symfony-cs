<?php

declare(strict_types = 1);

namespace App\Framework\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTAuthenticatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTEncodedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Contracts\Cache\CacheInterface;

class JWTListener
{
    public function __construct(
        private readonly CacheInterface $loginCache,
        private readonly JWTTokenManagerInterface $jwtManager
    )
    {
    }

    public function onJWTAuthenticated(JWTAuthenticatedEvent $event): void
    {
        $user_id = base64_encode($event->getPayload()['email']);
        $this->loginCache->get($user_id,function (CacheItem $item){
            if(!$item->isHit()){
                throw new HttpException(401,"Usuário não está logado");
            }
        });
    }

    public function onJWTEncoded(JWTEncodedEvent $event): void
    {
        $user_id = base64_encode($this->jwtManager->parse($event->getJWTString())['email']);
        $this->loginCache->get($user_id,function (CacheItem $item)use ($event){
            $ttl = (int) $_ENV['LOGIN_KEY_TTL'];
            $item->set($event->getJWTString());
            $item->expiresAfter($ttl);
        });
    }

    public function onJWTNotFound(JWTNotFoundEvent $event): void
    {
        $data = [
            "mensagem" => "Token não encontrado"
        ];

        $response = new JsonResponse($data,401);

        $event->setResponse($response);
    }

    public function onJWTExpired(JWTExpiredEvent $event): void
    {
        $data = [
            "mensagem" => "Token expirado"
        ];

        $response = new JsonResponse($data,401);

        $event->setResponse($response);
    }

    public function onJWTInvalid(JWTInvalidEvent $event): void
    {
        $data = [
            "mensagem" => "Token Inválido"
        ];

        $response = new JsonResponse($data,401);

        $event->setResponse($response);
    }
}
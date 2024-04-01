<?php

namespace App\Framework\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTAuthenticatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTEncodedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\Cache\CacheInterface;

class JWTListener
{
    public function __construct(private CacheInterface $loginCache,private TokenExtractorInterface $tokenExtractor)
    {
    }

    public function onJWTAuthenticated(JWTAuthenticatedEvent $event): void
    {
        $token = ($this->tokenExtractor->extract(Request::createFromGlobals()));
        $this->loginCache->get($token,function (CacheItem $item){
            if(!$item->isHit()){
                throw new HttpException(401,"Usuário não está logado");
            }
        });
    }

    public function onJWTEncoded(JWTEncodedEvent $event): void
    {
        $this->loginCache->get($event->getJWTString(),function (CacheItem $item)use ($event){
            $ttl = (int) $_ENV['LOGIN_KEY_TTL'];
            $item->set(true);
            $item->expiresAfter($ttl);
        });
    }

    public function onJWTNotFound(JWTNotFoundEvent $event): void
    {
        $data = [
            "message" => "Token não encontrado"
        ];

        $response = new JsonResponse($data,401);

        $event->setResponse($response);
    }

    public function onJWTExpired(JWTExpiredEvent $event): void
    {
        $data = [
            "message" => "Token expirado"
        ];

        $response = new JsonResponse($data,401);

        $event->setResponse($response);
    }

    public function onJWTInvalid(JWTInvalidEvent $event): void
    {
        $data = [
            "message" => "Token Inválido"
        ];

        $response = new JsonResponse($data,401);

        $event->setResponse($response);
    }
}
<?php

namespace App\Framework\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTAuthenticatedEvent;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerArgumentsEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Contracts\Cache\CacheInterface;

class JWTAuthenticatedListener
{

    public function __construct(private CacheInterface $loginCache,private TokenExtractorInterface $tokenExtractor)
    {
    }

    public function __invoke(JWTAuthenticatedEvent $event): void
    {
        $token = ($this->tokenExtractor->extract(Request::createFromGlobals()));
        $this->loginCache->get($token,function (CacheItem $item){
            if(!$item->isHit()){
                throw new HttpException(401,"Usuário não está logado");
            }
        });
    }
}
<?php

namespace App\Framework\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTEncodedEvent;
use Symfony\Component\Cache\CacheItem;
use Symfony\Contracts\Cache\CacheInterface;

class JWTEncodedListener
{
    public function __construct(private CacheInterface $loginCache)
    {
    }

    public function __invoke(JWTEncodedEvent $event): void
    {
       $this->loginCache->get($event->getJWTString(),function (CacheItem $item)use ($event){
           $ttl = (int) $_ENV['LOGIN_KEY_TTL'];
           $item->set(true);
           $item->expiresAfter($ttl);
       });
    }
}
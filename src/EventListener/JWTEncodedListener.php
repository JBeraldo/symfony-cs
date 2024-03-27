<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTEncodedEvent;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\CacheItem;
use Symfony\Contracts\Cache\CacheInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class JWTEncodedListener
{
    public function __construct(private CacheInterface $loginCache)
    {
    }

    public function __invoke(JWTEncodedEvent $event): void
    {
       $this->loginCache->get($event->getJWTString(),function (CacheItem $item)use ($event){
           $ttl = (int) $_ENV['LOGIN_KEY_TTL'];
           $item->set($event->getJWTString());
           $item->expiresAfter($ttl);
       });
    }
}
<?php

namespace App\Http\Controller;

use App\Domain\Service\UserService;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
#[Route('/health', name: 'health')]
class HealthController extends AbstractController
{
    public function __construct(
    )
    {
    }
    #[Route('/info', name: '_info', methods: ['GET'])]
    public function info(Request $request)
    {
        return phpinfo();
    }

    #[Route('/jit', name: '_jit', methods: ['GET'])]
    public function jit(Request $request)
    {
        return $this->json(opcache_get_status()['jit']);
    }
}
<?php

declare(strict_types = 1);

namespace App\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/health', name: 'health')]
class HealthController extends AbstractController
{
    public function __construct(
    )
    {
    }

    #[Route('/ping', name: '_pong', methods: ['GET'])]
    public function ping(Request $request)
    {
        return new Response('pong',200);
    }
}
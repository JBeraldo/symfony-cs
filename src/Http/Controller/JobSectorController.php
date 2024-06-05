<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\Service\JobSectorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class JobSectorController extends AbstractController
{
    public function __construct(
        private readonly JobSectorService $service
    )
    {
    }

    #[Route('/ramos', name: 'job_sectors_get', methods: ['GET'])]
    public function get(Request $request): JsonResponse
    {
        $skills = $this->service->getAllSectors();

        return $this->json($skills);
    }
}
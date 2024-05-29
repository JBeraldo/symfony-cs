<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\Service\SkillService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class SkillController extends AbstractController
{
    public function __construct(
        private readonly SkillService $service
    )
    {
    }

    #[Route('/competencias', name: 'skills_get', methods: ['GET'])]
    public function get(Request $request): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $skills = $this->service->getAllSkills();

        return $this->json($skills);
    }
}
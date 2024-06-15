<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Domain\Service\JobSectorService;
use App\Domain\Service\JobService;
use App\Framework\Resolver\RequestPayloadValueResolver;
use App\Http\Request\Candidate\CreateCandidateRequest;
use App\Http\Request\Job\CreateJobRequest;
use App\Http\Request\Job\UpdateJobRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class JobController extends AbstractController
{
    public function __construct(
        private readonly JobService $service
    )
    {
    }

    #[Route('/vagas', name: 'job_create', methods: ['POST'])]
    #[IsGranted('ROLE_COMPANY', message: 'Rodo Paizão.')]
    public function store(#[MapRequestPayload(resolver: RequestPayloadValueResolver::class)] CreateJobRequest $jobDTO): JsonResponse
    {
        $this->service->store($jobDTO);

        return $this->json(['mensagem' => 'Vaga cadastrada com sucesso!']);
    }

    #[Route('/vagas/{id}', name: 'job_update', methods: ['PUT'])]
    #[IsGranted('ROLE_COMPANY', message: 'Rodo Paizão.')]
    public function update(#[MapRequestPayload(resolver: RequestPayloadValueResolver::class)] UpdateJobRequest $jobDTO): JsonResponse
    {
        $this->service->update($jobDTO);

        return $this->json(['mensagem' => 'Vaga atualizada com sucesso!']);
    }

    #[Route('/vagas', name: 'job_list', methods: ['GET'])]
    public function get(): JsonResponse
    {
        $jobs = $this->service->get();

        return $this->json($jobs);
    }

    #[Route('/vagas/{id}', name: 'job_find', methods: ['GET'])]
    public function find(int $id): JsonResponse
    {
        $jobs = $this->service->find($id);

        return $this->json($jobs);
    }

    #[Route('/vagas/{id}', name: 'job_delete', methods: ['DELETE'])]
    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);

        return $this->json(['mensagem' => 'Vaga excluída com sucesso!']);
    }
}
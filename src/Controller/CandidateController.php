<?php

namespace App\Controller;

use App\DTO\Candidate\CandidateDTO;
use App\Resolver\RequestPayloadValueResolver;
use App\Service\CandidateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/usuarios', name: 'user_candidate_')]
class CandidateController extends AbstractController
{
    ##TODO colocar assert de tamanho dtos
    public function __construct(private CandidateService $service)
    {
    }

    #[Route('/candidato', name: 'store',methods: ['POST'], format: 'json')]
    public function store(#[MapRequestPayload(resolver: RequestPayloadValueResolver::class)] CandidateDTO $candidateDTO): Response
    {
        $this->service->store($candidateDTO);

        return $this->json([],201);
    }
}

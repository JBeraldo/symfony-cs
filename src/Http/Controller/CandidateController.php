<?php

namespace App\Http\Controller;

use App\Domain\Service\CandidateService;
use App\Framework\Resolver\RequestPayloadValueResolver;
use App\Http\Request\Candidate\CreateCandidateRequest;
use App\Http\Request\Candidate\UpdateCandidateRequest;
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
    public function store(#[MapRequestPayload(resolver: RequestPayloadValueResolver::class)] CreateCandidateRequest $candidateDTO): Response
    {
        $this->service->store($candidateDTO);

        return $this->json(["mensagem" => "Usuário cadastrado com sucesso"], Response::HTTP_CREATED);
    }

    #[Route('/candidato', name: 'store',methods: ['PUT'], format: 'json')]
    public function update(#[MapRequestPayload(resolver: RequestPayloadValueResolver::class)] UpdateCandidateRequest $candidateDTO): Response
    {
        $this->service->update($candidateDTO);
        return $this->json(["mensagem" => "Usuário cadastrado com sucesso"], Response::HTTP_OK);
    }
}

<?php

declare(strict_types = 1);

namespace App\Http\Controller;

use App\Domain\Service\CandidateService;
use App\Domain\Service\CompanyService;
use App\Framework\Resolver\RequestPayloadValueResolver;
use App\Http\Request\Candidate\CreateCandidateRequest;
use App\Http\Request\Candidate\UpdateCandidateRequest;
use App\Http\Request\Company\CreateCompanyRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/usuarios', name: 'user_company_')]
class CompanyController extends AbstractController
{
    ##TODO colocar assert de tamanho dtos
    public function __construct(private readonly CompanyService $service)
    {
    }

    #[Route('/empresa', name: 'store',methods: ['POST'], format: 'json')]
    public function store(#[MapRequestPayload(resolver: RequestPayloadValueResolver::class)] CreateCompanyRequest $candidateDTO): Response
    {
        $this->service->store($candidateDTO);

        return $this->json(["mensagem" => "Usuário cadastrado com sucesso"], Response::HTTP_CREATED);
    }

    #[Route('/empresa', name: 'update',methods: ['PUT'], format: 'json')]
    public function update(#[MapRequestPayload(resolver: RequestPayloadValueResolver::class)] UpdateCandidateRequest $candidateDTO): Response
    {
        $this->service->update($candidateDTO);
        return $this->json(["mensagem" => "Usuário cadastrado com sucesso"], Response::HTTP_OK);
    }
}

<?php

namespace App\Domain\Service;

use App\Domain\Repository\CandidateRepository;
use App\Domain\Repository\UserRepository;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Request\Candidate\CreateCandidateRequest;

readonly class CandidateService
{
    public function __construct(
        private CandidateRepository $candidateRepository,
    )
    {}

    public function store(CreateCandidateRequest $candidateDTO):void
    {
        $user = CandidateAdapter::ResourceToUser($candidateDTO);
        $this->candidateRepository->store($user);
    }
}
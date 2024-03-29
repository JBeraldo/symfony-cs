<?php

namespace App\Domain\Service;

use App\Domain\Repository\UserRepository;
use App\Http\Adapter\CandidateUserAdapter;
use App\Http\Request\Candidate\CreateCandidateRequest;

readonly class CandidateService
{
    public function __construct(
        private UserRepository $userRepository,
    )
    {}

    public function store(CreateCandidateRequest $candidateDTO):void
    {
        $user = CandidateUserAdapter::ResourceToUser($candidateDTO);
        $this->userRepository->store($user);
    }
}
<?php

namespace App\Domain\Service;

use App\Data\Repository\UserRepository;
use App\DTO\Candidate\CreateCandidateRequest;
use App\Http\Adapter\CandidateUserAdapter;

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
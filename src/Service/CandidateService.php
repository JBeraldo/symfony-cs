<?php

namespace App\Service;

use App\Adapter\CandidateUserAdapter;
use App\DTO\Candidate\CandidateDTO;
use App\Repository\UserRepository;
use Lcobucci\JWT\Decoder;

readonly class CandidateService
{
    public function __construct(
        private UserRepository $userRepository,
    )
    {}

    public function store(CandidateDTO $candidateDTO):void
    {
        $user = CandidateUserAdapter::ResourceToUser($candidateDTO);
        $this->userRepository->store($user);
    }
}
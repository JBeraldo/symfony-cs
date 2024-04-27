<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Repository\CandidateRepository;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Request\Candidate\CreateCandidateRequest;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 *
 */
readonly class CandidateService
{
    public function __construct(
        private CandidateRepository $candidateRepository,
    )
    {}

    /**
     * @return void
     */
    public function store(CreateCandidateRequest $candidateDTO):void
    {
        $user = CandidateAdapter::ResourceToUser($candidateDTO);
        try {
            $this->candidateRepository->store($user);
        }catch (UniqueConstraintViolationException)
        {
            throw new \HttpException("Email já utilizado",422);
        }
    }

}
<?php

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
    /**
     * @param CandidateRepository $candidateRepository
     */
    public function __construct(
        private CandidateRepository $candidateRepository,
    )
    {}

    /**
     * @param CreateCandidateRequest $candidateDTO
     * @return void
     */
    public function store(CreateCandidateRequest $candidateDTO):void
    {
        $user = CandidateAdapter::ResourceToUser($candidateDTO);
        try {
            $this->candidateRepository->store($user);
        }catch (UniqueConstraintViolationException $e)
        {
            throw new \HttpException("Email já utilizado",422);
        }
    }

}
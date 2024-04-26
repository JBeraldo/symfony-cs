<?php

namespace App\Domain\Service;

use App\Domain\Repository\CandidateRepository;
use App\Domain\Repository\UserRepository;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Adapter\CompanyAdapter;
use App\Http\Request\Candidate\CreateCandidateRequest;
use App\Http\Request\Company\CreateCompanyRequest;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 *
 */
readonly class CompanyService
{
    /**
     * @param CandidateRepository $companyRepository
     */
    public function __construct(
        private UserRepository $companyRepository,
    )
    {}

    /**
     * @param CreateCandidateRequest $companyDTO
     * @return void
     * @throws \HttpException
     */
    public function store(CreateCompanyRequest $companyDTO):void
    {
        $user = CompanyAdapter::ResourceToUser($companyDTO);
        try {
            $this->companyRepository->store($user);
        }catch (UniqueConstraintViolationException $e)
        {
            throw new \HttpException("Email já utilizado",422);
        }
    }

}
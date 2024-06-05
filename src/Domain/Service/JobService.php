<?php

namespace App\Domain\Service;

use App\Domain\Repository\JobRepository;
use App\Domain\Repository\JobSectorRepository;
use App\Http\Adapter\JobAdapter;
use App\Http\Adapter\JobSectorAdapter;
use App\Http\Request\Job\CreateJobRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\SecurityBundle\Security;

readonly class JobService
{
    public function __construct(
        private JobRepository $jobRepository,
        private Security $security
    )
    {
    }

    public function store(CreateJobRequest $request): void
    {
        $user = $this->security->getUser();
        $skills = $this->jobRepository->store($request,$user);
    }
    public function get(): array
    {
        $user = $this->security->getUser();
        return JobAdapter::convertJobs($this->jobRepository->getByCompany($user));
    }

}
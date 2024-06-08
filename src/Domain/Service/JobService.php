<?php

namespace App\Domain\Service;

use App\Domain\Repository\JobRepository;
use App\Http\Adapter\JobAdapter;
use App\Http\Request\Job\CreateJobRequest;
use App\Http\Request\Job\UpdateJobRequest;
use App\Http\Resource\JobResource;
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
        $this->jobRepository->store($request,$user);
    }
    public function update(UpdateJobRequest $request): void
    {
        $user = $this->security->getUser();
        $this->jobRepository->update($request,$user);
    }
    public function get(): array
    {
        $user = $this->security->getUser();
        return JobAdapter::convertJobs($this->jobRepository->getByCompany($user));
    }

    public function find(int $id): JobResource
    {
        return JobAdapter::JobToResouceList($this->jobRepository->find($id));
    }

    public function destroy(int $id): void
    {
        $job = $this->jobRepository->find($id);
        $this->jobRepository->destroy($job);
    }
}
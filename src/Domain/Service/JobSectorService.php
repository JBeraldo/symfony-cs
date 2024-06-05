<?php

namespace App\Domain\Service;

use App\Domain\Repository\JobSectorRepository;
use App\Http\Adapter\JobSectorAdapter;
use Doctrine\Common\Collections\ArrayCollection;

readonly class JobSectorService
{
    public function __construct(private JobSectorRepository $jobSectorRepository)
    {
    }

    public function getAllSectors(): array
    {
        $skills = $this->jobSectorRepository->findAll();
        return JobSectorAdapter::convertSectors(new ArrayCollection($skills));
    }
}
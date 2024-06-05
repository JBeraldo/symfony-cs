<?php

namespace App\Domain\Service;

use App\Domain\Repository\SkillRepository;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Adapter\SkillAdapter;
use Doctrine\Common\Collections\ArrayCollection;

readonly class SkillService
{
    public function __construct(private SkillRepository $skillRepository)
    {
    }

    public function getAllSkills(): array
    {
        $skills = $this->skillRepository->findAll();
        return SkillAdapter::convertSkills(new ArrayCollection($skills));
    }
}
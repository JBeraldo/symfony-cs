<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\JobSector;
use App\Domain\Entity\Skill;
use App\Http\Resource\JobSectorResource;
use Doctrine\Common\Collections\Collection;

class JobSectorAdapter
{
    public static function sectorToResource(JobSector $sector): JobSectorResource
    {
        $resource = new JobSectorResource();
        $resource->setId($sector->getId());
        $resource->setNome($sector->getName());
        $resource->setDescricao($sector->getDescription());
        return $resource;
    }

    public static function requestToSkill(array $skill_array): Skill
    {
        $skill = new Skill();
        $skill->setId($skill_array['id']);
        $skill->setName($skill_array['nome']);
        return $skill;
    }

    public static function convertSectors(Collection $sectors):array
    {
        $sectors_array = [];
        foreach ($sectors as $s)
        {
            $sectors_array[] = JobSectorAdapter::sectorToResource($s);
        }
        return $sectors_array;
    }
}
<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\Skill;
use App\Http\Resource\SkillResource;

class SkillAdapter
{
    public static function skillToResource(Skill $skill): SkillResource
    {
        $resource = new SkillResource();
        $resource->setId($skill->getId());
        $resource->setNome($skill->getName());
        return $resource;
    }

    public static function requestToSkill(array $skill): Skill
    {
        $resource = new SkillResource();
        $resource->setId($skill->getId());
        $resource->setNome($skill->getName());
        return $resource;
    }
}
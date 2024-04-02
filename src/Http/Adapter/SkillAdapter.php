<?php

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
}
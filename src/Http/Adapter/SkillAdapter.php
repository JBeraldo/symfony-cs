<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\Skill;
use App\Http\Resource\SkillResource;
use Doctrine\Common\Collections\Collection;

class SkillAdapter
{
    public static function skillToResource(Skill $skill): SkillResource
    {
        $resource = new SkillResource();
        $resource->setId($skill->getId());
        $resource->setNome($skill->getName());
        return $resource;
    }

    public static function requestToSkill(array $skill_array): Skill
    {
        $skill = new Skill();
        $skill->setId($skill_array['id']);
        $skill->setName($skill_array['nome']);
        return $skill;
    }

    public static function convertSkills(Collection $skills):array
    {
        $skills_array = [];
        foreach ($skills as $s)
        {
            $skills_array[] = SkillAdapter::skillToResource($s);
        }
        return $skills_array;
    }
}
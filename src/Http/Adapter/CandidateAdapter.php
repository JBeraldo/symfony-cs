<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\User;
use App\Http\Request\Candidate\CreateCandidateRequest;
use App\Http\Resource\CandidateResource;
use Doctrine\Common\Collections\Collection;

class CandidateAdapter
{
    public static function ResourceToUser(CreateCandidateRequest $candidateDTO): User
    {
        $user = new User();
        $user->setUsername($candidateDTO->nome);
        $user->setEmail($candidateDTO->email);
        $user->setPassword($candidateDTO->senha);
        $user->setRoles(['ROLE_CANDIDATE']);
        return $user;
    }

    public static function userToResource(User $user): CandidateResource
    {
        $resource = new CandidateResource();
        $resource->setNome($user->getUsername());
        $resource->setTipo('candidato');
        $resource->setEmail($user->getEmail());
        $resource->setExperiencias(self::convertExperiences($user->getExperiences()));
        $resource->setCompetencias(self::convertSkills($user->getSkills()));
        return $resource;
    }

    private static function convertExperiences(Collection $experiences):array
    {
        $experiences_array = [];
        foreach ($experiences as $xp)
        {
            $experiences_array[] = ExperienceAdapter::ExperienceToResource($xp);
        }
        return $experiences_array;
    }

    private static function convertSkills(Collection $skills):array
    {
        $skills_array = [];
        foreach ($skills as $s)
        {
            $skills_array[] = SkillAdapter::skillToResource($s);
        }
        return $skills_array;
    }
}
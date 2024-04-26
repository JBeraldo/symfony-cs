<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\User;
use App\Http\Request\Candidate\CreateCandidateRequest;
use App\Http\Request\Candidate\UpdateCandidateRequest;
use App\Http\Request\Request;
use App\Http\Resource\CandidateResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class CandidateAdapter
{
    public static function ResourceToUser(Request $candidateDTO): User
    {
        $user = new User();
        $user->setUsername($candidateDTO->nome);
        $user->setEmail($candidateDTO->email);
        $user->setPassword($candidateDTO->senha);
        $user->setRoles(['ROLE_CANDIDATE']);
        if($candidateDTO instanceof UpdateCandidateRequest){
            $user->setExperiences(self::convertExperiencias($candidateDTO->experiencias));
            $user->setSkills(self::convertCompetencias($candidateDTO->competencias));
        }
        return $user;
    }

    public static function userToResource(User $user): CandidateResource
    {
        $resource = new CandidateResource();
        $resource->setNome($user->getUsername());
        $resource->setEmail($user->getEmail());
        $resource->setTipo('candidato');
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

    private static function convertExperiencias(array $experiences):Collection
    {
        $experiences_array = new ArrayCollection();
        foreach ($experiences as $xp)
        {
            $experiences_array->add(ExperienceAdapter::requestToExperience($xp));
        }
        return $experiences_array;
    }

    private static function convertCompetencias(array $competencias): Collection
    {
        $skills_array = new ArrayCollection();
        foreach ($competencias as $c)
        {
            $skills_array->add(SkillAdapter::requestToSkill($c));
        }
        return $skills_array;
    }
}
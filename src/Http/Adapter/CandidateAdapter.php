<?php

namespace App\Http\Adapter;

use App\Domain\Entity\User;
use App\Http\Request\Request;
use App\Http\Resource\CandidateResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

class CandidateAdapter
{

    public static function ResourceToUser(Request $candidateDTO,UserInterface $user = new User()): User
    {
        $user->setUsername($candidateDTO->nome);
        $user->setEmail($candidateDTO->email);
        $user->setRoles(['ROLE_CANDIDATE']);
        $user->setPassword($candidateDTO->senha);
        return $user;
    }

    public static function userToResource(User $user): CandidateResource
    {
        $resource = new CandidateResource();
        $resource->setNome($user->getUsername());
        $resource->setEmail($user->getEmail());
        $resource->setTipo('candidato');
        $resource->setExperiencia(self::convertExperiences($user->getExperiences()));
        $resource->setCompetencias(SkillAdapter::convertSkills($user->getSkills()));
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




    private static function convertCompetencias(User $user,array $competencias): Collection
    {
        $skills_array = new ArrayCollection();
        foreach ($competencias as $c)
        {
            if(!$user->getSkills()->contains($c)){
                $skills_array->add(SkillAdapter::requestToSkill($c));
            }
        }
        return $skills_array;
    }

}
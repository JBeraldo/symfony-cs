<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\Experience;
use App\Http\Resource\ExperienceResource;
use DateTime;

class ExperienceAdapter
{
    public static function ExperienceToResource(Experience $experience): ExperienceResource
    {
        $resource = new ExperienceResource();
        $resource->setId($experience->getId());
        $resource->setNomeEmpresa($experience->getCompanyName());
        $resource->setCargo($experience->getPosition());
        $resource->setInicio(self::DateToResouceDate($experience->getStartDate()));
        $resource->setFim(self::DateToResouceDate($experience->getEndDate()));
        return $resource;
    }

    public static function requestToExperience(array $experiencia): Experience
    {
        $experience = new Experience();
        $experience->setPosition($experiencia['cargo']);
        $experience->setCompanyName($experiencia['nome_empresa']);
        if(!is_null($experiencia['fim'])){
            $experience->setEndDate($experiencia['fim']);
        }
        $experience->setStartDate($experiencia['inicio']);
        if(isset($experiencia['id'])){
            $experience->setId($experiencia['id']);
        }
        return $experience;
    }

    public static function updateExperience(Experience $old_experience,Experience $experience): Experience
    {
        $old_experience->setPosition($experience->getPosition());
        $old_experience->setCompanyName($experience->getCompanyName());
        if(!is_null($experience->getEndDate())){
            $old_experience->setEndDate($experience->getEndDate()->format('Y-m-d'));
        }
        $old_experience->setStartDate($experience->getStartDate()->format('Y-m-d'));
        return $old_experience;
    }

    private static function DateToResouceDate(?DateTime $datetime): ?string
    {
        return $datetime?->format('Y-m-d');
    }
}
<?php

namespace App\Http\Adapter;

use App\Domain\Entity\Experience;
use App\Http\Resource\ExperienceResource;

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

    private static function DateToResouceDate(?\DateTime $datetime): ?string
    {
        if($datetime === null){
            return null;
        }
        $month = $datetime->format('M');
        $year = $datetime->format('Y');
        return  "$month/$year";
    }
}
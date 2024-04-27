<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\User;
use App\Http\Request\Company\CreateCompanyRequest;
use App\Http\Resource\CompanyResource;

class CompanyAdapter
{
    public static function ResourceToUser(CreateCompanyRequest $companyDTO): User
    {
        $user = new User();
        $user->setUsername($companyDTO->nome);
        $user->setEmail($companyDTO->email);
        $user->setPassword($companyDTO->senha);
        $user->setSegment($companyDTO->ramo);
        $user->setDescription($companyDTO->descricao);
        $user->setRoles(['ROLE_COMPANY']);
        /*if ($companyDTO instanceof UpdateCandidateRequest) {
            $user->setExperiences(self::convertExperiencias($companyDTO->experiencias));
            $user->setSkills(self::convertCompetencias($companyDTO->competencias));
        }*/
        return $user;
    }

    public static function userToResource(User $user): CompanyResource
    {
        $resource = new CompanyResource();
        $resource->setNome($user->getUsername());
        $resource->setEmail($user->getEmail());
        $resource->setRamo($user->getSegment());
        $resource->setTipo('empresa');
        $resource->setDescricao($user->getDescription());
        return $resource;
    }
}
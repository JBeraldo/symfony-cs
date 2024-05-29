<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\User;
use App\Http\Request\Request;
use App\Http\Request\User\UpdateUserRequest;
use App\Http\Resource\CompanyResource;
use Symfony\Component\Security\Core\User\UserInterface;

class CompanyAdapter
{
    public static function ResourceToUser(Request $companyDTO, UserInterface $user = new User()): User
    {
        $user->setUsername($companyDTO->nome);
        $user->setEmail($companyDTO->email);
        $user->setSegment($companyDTO->ramo);
        $user->setDescription($companyDTO->descricao);
        $user->setRoles(['ROLE_COMPANY']);
        if(!$companyDTO instanceof UpdateUserRequest){
            $user->setPassword($companyDTO->senha);
        }
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
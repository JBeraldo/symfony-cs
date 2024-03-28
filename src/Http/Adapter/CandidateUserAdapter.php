<?php

declare(strict_types = 1);

namespace App\Http\Adapter;

use App\Domain\Entity\User;
use App\Http\Request\Candidate\CreateCandidateRequest;
use App\Http\Resource\CandidateResource;

class CandidateUserAdapter
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
        #Todo: Colocar Competencias e Experiencias quando implementar relações
        return $resource;
    }
}
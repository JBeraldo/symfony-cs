<?php

namespace App\Adapter;

use App\DTO\Candidate\CandidateDTO;
use App\DTO\User\UserDTO;
use App\Entity\User;

class CandidateUserAdapter
{
    public static function ResourceToUser(CandidateDTO $candidateDTO): User
    {
        $user = new User();
        $user->setUsername($candidateDTO->nome);
        $user->setEmail($candidateDTO->email);
        $user->setPassword($candidateDTO->senha);
        return $user;
    }
}
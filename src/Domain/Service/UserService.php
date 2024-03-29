<?php

namespace App\Domain\Service;

use App\Domain\Repository\UserRepository;
use App\Http\Adapter\CandidateUserAdapter;
use App\Http\Resource\UserResource;
use Symfony\Bundle\SecurityBundle\Security;

readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private Security $security
    )
    {}
    public function currentUser(): UserResource
    {
        $user = $this->security->getUser();

        return CandidateUserAdapter::userToResource($user);
    }

}
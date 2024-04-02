<?php

namespace App\Domain\Service;

use App\Domain\Repository\CandidateRepository;
use App\Domain\Repository\UserRepository;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Resource\UserResource;
use Symfony\Bundle\SecurityBundle\Security;

readonly class UserService
{
    public function __construct(
        private CandidateRepository $candidateRepository,
        private Security $security
    )
    {}
    public function currentUser(): UserResource
    {
        $user = $this->security->getUser();

        if($user->isCandidate()){
            $candidate = $this->candidateRepository->findWithRelations($user->getId());
            return CandidateAdapter::userToResource($candidate);
        }
        else{
            return CandidateAdapter::userToResource($user);

        }
    }

}
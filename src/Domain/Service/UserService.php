<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;
use App\Domain\Repository\CandidateRepository;
use App\Domain\Repository\UserRepository;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Resource\UserResource;
use Symfony\Bundle\SecurityBundle\Security;

/**
 *
 */
readonly class UserService
{
    /**
     * @param CandidateRepository $candidateRepository
     * @param Security $security
     */
    public function __construct(
        private CandidateRepository $candidateRepository,
        private UserRepository $userRepository,
        private Security $security
    )
    {}

    /**
     * @return UserResource
     * @throws \Doctrine\ORM\Exception\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
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

    /**
     * @return void
     */
    public function destroy()
    {
        $user = $this->security->getUser();
        $this->userRepository->destroy($user);
    }

}
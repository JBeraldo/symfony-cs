<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Repository\CandidateRepository;
use App\Domain\Repository\UserRepository;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Adapter\CompanyAdapter;
use App\Http\Resource\UserResource;
use Symfony\Bundle\SecurityBundle\Security;

/**
 *
 */
readonly class UserService
{
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
            return CompanyAdapter::userToResource($user);

        }
    }

    /**
     * @return void
     */
    public function destroy(): void
    {
        $user = $this->security->getUser();
        $this->userRepository->destroy($user);
    }

    public function update()
    {

    }

}
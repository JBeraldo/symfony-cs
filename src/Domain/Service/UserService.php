<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Repository\CandidateRepository;
use App\Domain\Repository\ExperienceRepository;
use App\Domain\Repository\UserRepository;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Adapter\CompanyAdapter;
use App\Http\Request\User\UpdateUserRequest;
use App\Http\Resource\UserResource;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bundle\SecurityBundle\Security;

/**
 *
 */
readonly class UserService
{
    public function __construct(
        private CandidateRepository $candidateRepository,
        private ExperienceRepository $experienceRepository,
        private UserRepository $userRepository,
        private Security $security
    )
    {}

    /**
     * @return UserResource
     * @throws ORMException
     * @throws OptimisticLockException
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

    public function update(UpdateUserRequest $updateUserRequest): void
    {
        $user = $this->security->getUser();

        if($user->isCandidate()){
            $this->candidateRepository->update($user->getId(),$updateUserRequest);
        }
        else{
            $this->userRepository->update($user->getId(),$updateUserRequest);
        }

    }

}
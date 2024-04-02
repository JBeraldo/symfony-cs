<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CandidateRepository extends UserRepository
{

    public function __construct(
        ManagerRegistry                              $registry,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly ExperienceRepository $experienceRepository,
        private readonly SkillRepository $skillRepository
    )
    {
        parent::__construct($registry, $this->passwordHasher);
    }


    public function findWithRelations(int $candidate_id): User
    {
        $em = $this->getEntityManager();
        $candidate = $em->find(User::class,$candidate_id);
        $candidate->setExperiences($this->experienceRepository->getByCandidate($candidate_id));
        $candidate->setSkills($this->skillRepository->getByCandidate($candidate_id));
        return $candidate;
    }
}
<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\User;
use App\Http\Adapter\CandidateAdapter;
use App\Http\Adapter\ExperienceAdapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
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

    /**
     * @param ManagerRegistry $registry
     * @param UserPasswordHasherInterface $passwordHasher
     * @param ExperienceRepository $experienceRepository
     * @param SkillRepository $skillRepository
     */
    public function __construct(
        private readonly ManagerRegistry             $registry,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly ExperienceRepository        $experienceRepository,
        private readonly SkillRepository             $skillRepository
    )
    {
        parent::__construct($registry, $this->passwordHasher);
    }

    public function update(int $id, $data): void
    {
        $model = $this->findWithRelations($id);
        $model = CandidateAdapter::ResourceToUser($data, $model);
        $skills_data = array_column($data->competencias, 'id');
        $skills_model = $model->getSkills()->map(fn($skill) => $skill->getId())->toArray();
        $xp_data = array_column($data->experiencia, 'id');
        $xp_model = $model->getExperiences()->map(fn($xp) => $xp->getId())->toArray();
        $remove_skill_ids = array_diff($skills_model, $skills_data);
        $remove_xp_ids = array_diff($xp_model, $xp_data);

        foreach ($data->competencias as $competencia) {
            $skill = $this->skillRepository->find($competencia['id']);
            if (!$model->getSkills()->contains($skill)) {
                $model->getSkills()->add($skill);
                $skill->getUsers()->add($model);
            }
        }
        foreach ($data->experiencia as $xp_data) {
            $xp_dto = ExperienceAdapter::requestToExperience($xp_data);
            if ($xp_dto->getId() === null) {
                $model->getExperiences()->add($xp_dto);
                $xp_dto->setCandidate($model);
            } else {
                $xp_model = $this->experienceRepository->find($xp_dto->getId());
                if (!$model->getExperiences()->contains($xp_model)) {
                    $model->getExperiences()->add($xp_model);
                } else {
                    $index = $model->getExperiences()->indexOf($xp_model);
                    $new_xp = $model->getExperiences()->get($index);
                    $new_xp = ExperienceAdapter::updateExperience($new_xp, $xp_dto);
                    $model->getExperiences()->set($index, $new_xp);
                }
            }

        }

        foreach ($remove_skill_ids as $remove_id) {
            $skill = $this->skillRepository->find($remove_id);
            $skill->getUsers()->remove($skill->getUsers()->indexOf($model));
        }

        foreach ($remove_xp_ids as $remove_id) {
            $xp = $this->experienceRepository->find($remove_id);
            $this->experienceRepository->destroy($xp);
        }

        if ($data->senha !== null) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $model,
                $data->senha
            );
            $model->setPassword($hashedPassword);
        }
        $this->getEntityManager()->persist($model);
        $this->getEntityManager()->flush();
    }

    /**
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function findWithRelations(int $candidate_id): User
    {
        $em = $this->getEntityManager();
        $candidate = $em->find(User::class, $candidate_id);
        $candidate->setExperiences($this->experienceRepository->getByCandidate($candidate_id));
        $candidate->setSkills($this->skillRepository->getByCandidate($candidate_id));
        return $candidate;
    }
}

<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Job;
use App\Domain\Entity\User;
use App\Http\Adapter\JobAdapter;
use App\Http\Request\Job\CreateJobRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Job>
 *
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(
        private readonly ManagerRegistry     $registry,
        private readonly JobSectorRepository $sectorRepository,
        private readonly SkillRepository     $skillRepository
    )
    {
        parent::__construct($registry, Job::class);
    }

    //    /**
    //     * @return Job[] Returns an array of Job objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('j.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Job
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function store(CreateJobRequest $request,User $user)
    {
        $job = JobAdapter::ResourceToJob($request);
        $sector = $this->sectorRepository->find($request->ramo_id);

        $job->setJobSector($sector);
        $job->setCompany($user);

        foreach ($request->competencias as $competencia) {
            $skill = $this->skillRepository->find($competencia['id']);
            if (!$job->getSkills()->contains($skill)) {
                $job->getSkills()->add($skill);
                $skill->getJobs()->add($job);
            }
        }

        $this->getEntityManager()->persist($job);
        $this->getEntityManager()->flush();
    }

    public function getByCompany(User $user)
    {
        $result = $this->getEntityManager()->createQuery('SELECT j FROM App\Domain\Entity\Job j WHERE j.company = :company')
            ->setParameter('company', $user)
            ->getResult();
        return new ArrayCollection($result);
    }
}

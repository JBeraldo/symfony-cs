<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Experience;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Experience>
 *
 * @method Experience|null find($id, $lockMode = null, $lockVersion = null)
 * @method Experience|null findOneBy(array $criteria, array $orderBy = null)
 * @method Experience[]    findAll()
 * @method Experience[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExperienceRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Experience::class);
    }

    //    /**
    //     * @return Experience[] Returns an array of Experience objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Experience
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    /**
     * @param $candidate_id
     * @return Collection
     */
    public function getByCandidate($candidate_id): Collection
        {
            $result = $this->createQueryBuilder('e')
                ->andWhere('e.candidate = :candidate_id')
                ->setParameter('candidate_id', $candidate_id)
                ->getQuery()
                ->getResult()
            ;

            return new ArrayCollection($result);
        }
    /**
     * @return void
     */
    public function destroy(Experience $xp): void
    {
        $this->getEntityManager()->remove($xp);
        $this->getEntityManager()->flush();
    }
}

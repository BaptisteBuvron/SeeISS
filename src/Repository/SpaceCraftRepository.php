<?php

namespace App\Repository;

use App\Entity\SpaceCraft;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpaceCraft|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceCraft|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceCraft[]    findAll()
 * @method SpaceCraft[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceCraftRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceCraft::class);
    }

    // /**
    //  * @return SpaceCraft[] Returns an array of SpaceCraft objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpaceCraft
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

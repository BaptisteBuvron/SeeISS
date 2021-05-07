<?php

namespace App\Repository;

use App\Entity\SpaceStation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpaceStation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceStation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceStation[]    findAll()
 * @method SpaceStation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceStationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceStation::class);
    }

    // /**
    //  * @return SpaceStation[] Returns an array of SpaceStation objects
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
    public function findOneBySomeField($value): ?SpaceStation
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

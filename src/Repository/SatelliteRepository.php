<?php

namespace App\Repository;

use App\Entity\Satellite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Satellite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Satellite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Satellite[]    findAll()
 * @method Satellite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SatelliteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Satellite::class);
    }

    // /**
    //  * @return Satellite[] Returns an array of Satellite objects
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
    public function findOneBySomeField($value): ?Satellite
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

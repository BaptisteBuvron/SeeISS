<?php

namespace App\Repository;

use App\Entity\Docking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Docking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Docking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Docking[]    findAll()
 * @method Docking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DockingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Docking::class);
    }

    // /**
    //  * @return Docking[] Returns an array of Docking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Docking
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Astronaut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Astronaut|null find($id, $lockMode = null, $lockVersion = null)
 * @method Astronaut|null findOneBy(array $criteria, array $orderBy = null)
 * @method Astronaut[]    findAll()
 * @method Astronaut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AstronautRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Astronaut::class);
    }

    // /**
    //  * @return Astronaut[] Returns an array of Astronaut objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Astronaut
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

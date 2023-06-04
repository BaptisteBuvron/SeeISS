<?php

namespace App\Repository;

use App\Entity\Starlink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Starlink|null find($id, $lockMode = null, $lockVersion = null)
 * @method Starlink|null findOneBy(array $criteria, array $orderBy = null)
 * @method Starlink[]    findAll()
 * @method Starlink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StarlinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Starlink::class);
    }

    /**
    * @return Starlink[] Returns an array of Starlink objects
    */
    public function findByNumberGreater($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.number >= :val')
            ->setParameter('val', $value)
            ->orderBy('s.number', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Starlink
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

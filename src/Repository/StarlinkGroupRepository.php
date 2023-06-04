<?php

namespace App\Repository;

use App\Entity\StarlinkGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StarlinkGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method StarlinkGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method StarlinkGroup[]    findAll()
 * @method StarlinkGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StarlinkGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StarlinkGroup::class);
    }

    // /**
    //  * @return StarlinkGroup[] Returns an array of StarlinkGroup objects
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


    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findLast(): ?StarlinkGroup
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.yearLaunch' , 'DESC')
            ->orderBy('s.numberLaunch', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}

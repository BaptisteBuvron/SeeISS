<?php

namespace App\Repository;

use App\Entity\Launcher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Launcher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Launcher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Launcher[]    findAll()
 * @method Launcher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LauncherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Launcher::class);
    }

    // /**
    //  * @return Launcher[] Returns an array of Launcher objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Launcher
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

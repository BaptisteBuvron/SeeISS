<?php

namespace App\Repository;

use App\Entity\SpaceCraftConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpaceCraftConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceCraftConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceCraftConfig[]    findAll()
 * @method SpaceCraftConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceCraftConfigRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceCraftConfig::class);
    }

    // /**
    //  * @return SpaceCraftConfig[] Returns an array of SpaceCraftConfig objects
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
    public function findOneBySomeField($value): ?SpaceCraftConfig
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

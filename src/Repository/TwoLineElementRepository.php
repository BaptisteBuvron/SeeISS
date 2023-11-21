<?php

namespace App\Repository;

use App\Entity\TwoLineElement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TwoLineElement>
 *
 * @method TwoLineElement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TwoLineElement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TwoLineElement[]    findAll()
 * @method TwoLineElement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TwoLineElementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TwoLineElement::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(TwoLineElement $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(TwoLineElement $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return TwoLineElement[] Returns an array of TwoLineElement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TwoLineElement
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Bl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bl|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bl|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bl[]    findAll()
 * @method Bl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bl::class);
    }

    // /**
    //  * @return Bl[] Returns an array of Bl objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bl
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

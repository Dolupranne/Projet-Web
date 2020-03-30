<?php

namespace App\Repository;

use App\Entity\PackJeton;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PackJeton|null find($id, $lockMode = null, $lockVersion = null)
 * @method PackJeton|null findOneBy(array $criteria, array $orderBy = null)
 * @method PackJeton[]    findAll()
 * @method PackJeton[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackJetonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PackJeton::class);
    }

    // /**
    //  * @return PackJeton[] Returns an array of PackJeton objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PackJeton
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

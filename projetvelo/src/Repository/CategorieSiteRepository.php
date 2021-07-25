<?php

namespace App\Repository;

use App\Entity\CategorieSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieSite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieSite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieSite[]    findAll()
 * @method CategorieSite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieSiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieSite::class);
    }

    // /**
    //  * @return CategorieSite[] Returns an array of CategorieSite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieSite
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

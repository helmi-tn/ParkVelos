<?php

namespace App\Repository;

use App\Entity\Categoriesite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categoriesite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoriesite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoriesite[]    findAll()
 * @method Categoriesite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoriesite::class);
    }

    // /**
    //  * @return Categoriesite[] Returns an array of Categoriesite objects
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
    public function findOneBySomeField($value): ?Categoriesite
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

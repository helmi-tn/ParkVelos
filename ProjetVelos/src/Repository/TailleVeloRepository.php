<?php

namespace App\Repository;

use App\Entity\TailleVelo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TailleVelo|null find($id, $lockMode = null, $lockVersion = null)
 * @method TailleVelo|null findOneBy(array $criteria, array $orderBy = null)
 * @method TailleVelo[]    findAll()
 * @method TailleVelo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TailleVeloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TailleVelo::class);
    }

    // /**
    //  * @return TailleVelo[] Returns an array of TailleVelo objects
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
    public function findOneBySomeField($value): ?TailleVelo
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

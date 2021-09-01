<?php

namespace App\Repository;

use App\Entity\Velo;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Velo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Velo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Velo[]    findAll()
 * @method Velo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VeloRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Velo::class);
    }

    // /**
    //  * @return Velo[] Returns an array of Velo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Velo
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByCommandeDate($datedebut, $datefin)
    {
        $sql = "
        select v.* from commande c LEFT JOIN commande_participant cp ON c.id = cp.commande_id LEFT JOIN participant p ON p.id = cp.participant_id LEFT JOIN velo v ON v.id = p.velo_id WHERE ( (c.findate < '2021-08-10' OR c.debutdate > '2021-08-15') AND v.disponibilite='disponible' ) UNION select v.* from participant p RIGHT JOIN velo v ON v.id = p.velo_id WHERE p.id is null AND v.disponibilite='disponible'";
            $rsmb = new ResultSetMappingBuilder($this->_em);
            $rsmb->addRootEntityFromClassMetadata(Velo::class,'u');
            $resultat = $this->_em->createNativeQuery($sql, $rsmb)->getResult();

        return $resultat;
    }
}

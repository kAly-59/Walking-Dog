<?php

namespace App\Repository;

use App\Entity\Foret;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Foret|null find($id, $lockMode = null, $lockVersion = null)
 * @method Foret|null findOneBy(array $criteria, array $orderBy = null)
 * @method Foret[]    findAll()
 * @method Foret[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Foret::class);
    }

    // /**
    //  * @return Foret[] Returns an array of Foret objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Foret
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\VoyageOrganise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method VoyageOrganise|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoyageOrganise|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoyageOrganise[]    findAll()
 * @method VoyageOrganise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageOrganiseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoyageOrganise::class);
    }

    // /**
    //  * @return VoyageOrganise[] Returns an array of VoyageOrganise objects
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
    public function findOneBySomeField($value): ?VoyageOrganise
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

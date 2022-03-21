<?php

namespace App\Repository;

use App\Entity\CompteBancaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompteBancaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteBancaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteBancaire[]    findAll()
 * @method CompteBancaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteBancaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteBancaire::class);
    }

    // /**
    //  * @return CompteBancaire[] Returns an array of CompteBancaire objects
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


    public function findOneByUserId($userId): ?CompteBancaire
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.user = :val')
            ->setParameter('val', $userId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

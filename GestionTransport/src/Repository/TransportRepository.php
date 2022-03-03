<?php

namespace App\Repository;

use App\Entity\Transport;
use App\Controller\TransportController;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transport[]    findAll()s
 * @method Transport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transport::class);
    }

    // /**
    //  * @return Transport[] Returns an array of Transport objects
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

/*    public function findOneBySomeField($value): ?Transport
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }*/

    public function findOneByMatricule($matricule): ?Transport
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.matricule = :matricule')
            ->setParameter('matricule', $matricule)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findByUserID($idUser)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.user = :val')
            ->setParameter('val', $idUser)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllByUserIDNull()
    {
        return $this->createQueryBuilder('t')
            ->Where('t.user IS NULL')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByCriteria($categorie, $prixMin, $prixMax) {
        return $this->createQueryBuilder('t')
            ->Where('t.categorie = :val')
            ->Where('t.prix IS IN (:val2,:val3)')
            ->setParameter('val', $categorie)
            ->setParameter('val2', $prixMin)
            ->setParameter('val3', $prixMax)
            ->getQuery()
            ->getResult()
            ;
    }

}

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

    public function findByCriterias($categorieId, $prixMin, $prixMax) {
        return $this->createQueryBuilder('t')
            ->Where('t.categorie = :val')
            ->andWhere('t.user IS NULL')
            ->andWhere('t.prix >= :val2')
            ->andWhere('t.prix <= :val3')
            ->setParameter('val', $categorieId)
            ->setParameter('val2', $prixMin)
            ->setParameter('val3', $prixMax)
            ->getQuery()
            ->getResult()
            ;
    }


    public function findNumberUsersByCategorieName($categorieName)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT c FROM App\Entity\Categorie c WHERE c.nom = :val'
        )->setParameter('val',$categorieName);

       $query->getResult();
        $idCategorie=array();
        foreach($query->getResult() as $categorie) {
            array_push($idCategorie,$categorie->getId());
        }

        $query2 =  $this->createQueryBuilder('t')
            ->where('t.categorie = :val' )
            ->andWhere('t.user IS NOT NULL' )
            ->setParameter('val',$idCategorie)
            ->groupBy("t.user")
            ->getQuery()
            ->getResult();

        $users=array();
        foreach($query2 as $user) {
            array_push($users,$user->getId());
        }

        return count($users);

    }

}

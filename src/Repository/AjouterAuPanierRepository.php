<?php

namespace App\Repository;

use App\Entity\AjouterAuPanier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AjouterAuPanier|null find($id, $lockMode = null, $lockVersion = null)
 * @method AjouterAuPanier|null findOneBy(array $criteria, array $orderBy = null)
 * @method AjouterAuPanier[]    findAll()
 * @method AjouterAuPanier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AjouterAuPanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AjouterAuPanier::class);
    }

    // /**
    //  * @return AjouterAuPanier[] Returns an array of AjouterAuPanier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AjouterAuPanier
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

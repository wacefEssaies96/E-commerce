<?php

namespace App\Repository;

use App\Entity\Panier;
use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Panier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panier[]    findAll()
 * @method Panier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panier::class);
    }
    // /**
    //  * @return Panier[] Returns an array of Panier objects
    //  */
     
    public function findByProduits($userId)
    {
        return $this->createQueryBuilder('p')
            ->select('pa','pp.id','pp.nom','pp.prix','pp.descProd','pp.filename','pp.qtt')    
            ->from(panier::class,'pa')
            ->join(Produits::class,'pp')
            ->where("pa.uid = $userId","pp.id = pa.pid","pa.confirm = 0")
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllOrderBy()
    {
        return $this->createQueryBuilder('c')
            ->where('c.confirm = 1')
            ->orderBy('c.uid')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOrder($id)
    {
        return $this->createQueryBuilder('c')
            ->andWhere("c.uid = $id")
            ->andWhere('c.confirm = 0')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Panier
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

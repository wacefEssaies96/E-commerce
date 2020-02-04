<?php

namespace App\Repository;

use App\Entity\Produits;
use App\Entity\ProduitSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    
    public function findAllT(ProduitSearch $search)
    {
      $query = $this->createQueryBuilder('p');
        if($search->getMinPrix()){
            $query = $query
                ->andWhere('p.prix >= :min')
                ->setParameter(':min',$search->getMinPrix());
        }
        if($search->getMaxPrix()){
            $query = $query
                ->andWhere('p.prix <= :max')
                ->setParameter(':max',$search->getMaxPrix());
        }
        $query
            ->getQuery()
            ->getResult();
        return $query;
    }
    public function findAllCategorie(ProduitSearch $search,$categorie)
    {
      $query = $this->createQueryBuilder('p');
        if($search->getMinPrix()){
            $query = $query
                ->andWhere('p.prix >= :min')
                ->setParameter(':min',$search->getMinPrix());
        }
        if($search->getMaxPrix()){
            $query = $query
                ->andWhere('p.prix <= :max')
                ->setParameter(':max',$search->getMaxPrix());
        }
        $query->andWhere('p.categorie = '.$categorie)->getQuery()->getResult();
        return $query;
    }
    

    // /**
    //  * @return Produits[] Returns an array of Produits objects
    //  */
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
    public function findOneBySomeField($value): ?Produits
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

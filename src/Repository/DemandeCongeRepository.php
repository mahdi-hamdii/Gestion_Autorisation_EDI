<?php

namespace App\Repository;

use App\Entity\DemandeConge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeConge|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeConge|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeConge[]    findAll()
 * @method DemandeConge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeCongeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeConge::class);
    }

     /**
      * @return DemandeConge[] Returns an array of DemandeConge objects
     */

    public function findBySender($sender)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.sender = :sender')
            ->setParameter('sender', $sender)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * @return DemandeConge[] Returns an array of DemandeConge objects
     */

    public function findByEtat($superiorId,$etat)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.superiorId = :superiorId')
            ->setParameter('superiorId', $superiorId)
            ->andWhere('d.etat = :etat')
            ->setParameter('etat',$etat)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return DemandeConge[]
     */

    public function findByType($employe)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.sender = :sender')
            ->setParameter('sender', $employe)
//            ->andWhere('d.type = :type')
//            ->setParameter('type',$type)
            ->orderBy('d.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    /*
    public function findOneBySomeField($value): ?DemandeConge
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Employe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Employe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employe[]    findAll()
 * @method Employe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employe::class);
    }

     /**
      * @return Employe[]
     */

    public function findByEmployer($employer)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.employer = :employer')
            ->setParameter('employer', $employer)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    public function findOneByEmail($email): ?Employe
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.email = :email')
//            ->setParameter('email', 'mahdi1@outlook.fr')
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}

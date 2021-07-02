<?php

namespace App\Repository;

use App\Entity\CodePostals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CodePostals|null find($id, $lockMode = null, $lockVersion = null)
 * @method CodePostals|null findOneBy(array $criteria, array $orderBy = null)
 * @method CodePostals[]    findAll()
 * @method CodePostals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CodePostalsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CodePostals::class);
    }

    // /**
    //  * @return CodePostals[] Returns an array of CodePostals objects
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

    /*
    public function findOneBySomeField($value): ?CodePostals
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\LearningCenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LearningCenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method LearningCenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method LearningCenter[]    findAll()
 * @method LearningCenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LearningCenterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LearningCenter::class);
    }

    // /**
    //  * @return LearningCenter[] Returns an array of LearningCenter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LearningCenter
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\LegalNotice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LegalNotice|null find($id, $lockMode = null, $lockVersion = null)
 * @method LegalNotice|null findOneBy(array $criteria, array $orderBy = null)
 * @method LegalNotice[]    findAll()
 * @method LegalNotice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LegalNoticeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LegalNotice::class);
    }

    // /**
    //  * @return LegalNotice[] Returns an array of LegalNotice objects
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
    public function findOneBySomeField($value): ?LegalNotice
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

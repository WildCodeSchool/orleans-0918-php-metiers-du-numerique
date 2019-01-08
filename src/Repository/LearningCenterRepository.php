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
    public function learningCenterCount()
    {
        $query = $this->createQueryBuilder('l')
            ->select('COUNT(l)')
            ->where('l.accepted = 0')
            ->getQuery();
        return $query->getSingleScalarResult();
    }
}

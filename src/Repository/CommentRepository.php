<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }
    public function commentCount()
    {
        $query = $this->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->getQuery();
        return $query->getSingleScalarResult();
    }
    public function commentNotAcceptedCountCount()
    {
        $query = $this->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->where('c.accepted = 0')
            ->getQuery();
        return $query->getSingleScalarResult();
    }
}

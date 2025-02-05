<?php

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Todo>
 */
class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function findAllOrderedById(): array
    {
        return $this->findBy(array('title' => '%saved%'), array('id' => 'ASC'));
    }
    public function findByTitleContaining(string $str, string $filter, string $sort = 'ASC'): array
    {
        $sortASC = strtoupper($sort) === 'DESC';
        $stmt = $this->createQueryBuilder('t')
            ->where('t.title LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $str . '%')
            ->orderBy('t.title', $sortASC ? 'DESC' : 'ASC');
        switch ($filter) {
            case "checked":
                $stmt->andWhere('t.finished = true');
                break;
            case "unchecked":
                $stmt->andWhere('t.finished = false');
                break;
        }
        return $stmt->getQuery()->getResult();
    }

    //    /**
    //     * @return Todo[] Returns an array of Todo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Todo
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

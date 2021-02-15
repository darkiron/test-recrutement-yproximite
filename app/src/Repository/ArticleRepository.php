<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param array{ status?: string, categories?: list<\App\Entity\ArticleCategory> } $filters
     *
     * @return list<Article>
     */
    public function findByFilters(array $filters = []): array
    {
        $qb = $this->createQueryBuilder('a');

        $qb
            ->addSelect('comments, categories')
            ->leftJoin('a.comments', 'comments')
            ->leftJoin('a.categories', 'categories');

        if (null !== ($status = $filters['status'] ?? null)) {
            // TODO: utiliser un `->where()` et un `setParameter()`
            $qb
                ->andWhere('a.status = :status')
                ->setParameter('status', $status)
            ;
            //$qb->andWhere($qb->expr()->eq('a.status', "'".$status."'"));
        }

        if (null !== ($categories = $filters['categories'] ?? null)) {
            $qb->andWhere('categories IN (:categories)');
            $qb->setParameter('categories', $categories);
        }

        return $qb->getQuery()->getResult();
    }
}

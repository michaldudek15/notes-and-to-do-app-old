<?php
/**
 * Note repository.
 */

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class TaskRepository.
 *
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Note>
 *
 * @psalm-suppress LessSpecificImplementedReturnType
 */
class NoteRepository extends ServiceEntityRepository
{

    public const PAGINATOR_ITEMS_PER_PAGE = 10;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);

    }


    public function queryAll(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()->select(
            'partial note.{id, createdAt,updatedAt, title, body}',
            'partial category.{id, title}'
        )
            ->join('note.category', 'category')->
            orderBy('note.updatedAt', 'DESC');
    }

    /**
     *  Get or create new query builder.
     *
     * @param  QueryBuilder|null $queryBuilder Query builder
     *
     * @return QueryBuilder Query builder
     */
    private function getOrCreateQueryBuilder(?QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return ($queryBuilder ?? $this->createQueryBuildeR('note'));

    }
}

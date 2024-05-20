<?php
/**
 * Note repository.
 */

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);

    }


    public function queryAll(): QueryBuilder
    {
        return $this->getOrCreateQueryBuilder()->select(
            'partial note.{id, createdAt, updatedAt, title, body}',
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

    public function countByCategory(Category $category): int
    {
        $qb = $this->getOrCreateQueryBuilder();

        return $qb->select($qb->expr()->countDistinct('note.id'))
            ->where('note.category = :note')
            ->setParameter(':category', $category)
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function save(Note $note): void
    {
        assert($this->_em instanceof EntityManager);
        $this->_em->persist($note);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Note $note Note entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(Note $note): void
    {
        assert($this->_em instanceof EntityManager);
        $this->_em->remove($note);
        $this->_em->flush();
    }

    private function getOrCreateQueryBuilder(?QueryBuilder $queryBuilder = null): QueryBuilder
    {
        return ($queryBuilder ?? $this->createQueryBuildeR('note'));
    }
}

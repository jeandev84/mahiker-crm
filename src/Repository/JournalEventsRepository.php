<?php

namespace App\Repository;

use App\Entity\JournalEvents;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JournalEvents>
 *
 * @method JournalEvents|null find($id, $lockMode = null, $lockVersion = null)
 * @method JournalEvents|null findOneBy(array $criteria, array $orderBy = null)
 * @method JournalEvents[]    findAll()
 * @method JournalEvents[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JournalEventsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JournalEvents::class);
    }

    public function save(JournalEvents $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JournalEvents $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



    /**
     * @return float|int|mixed|string
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCountEvents()
    {
        return $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }



    public function findRecentEventsQuery(): \Doctrine\ORM\Query
    {
        $qb = $this->createQueryBuilder('e');

        return $qb->orderBy('e.createdAt', 'desc')->getQuery();
    }




    public function findRecentEvents()
    {
         $qb = $this->createQueryBuilder('e');

         $qb->orderBy('e.createdAt', 'desc');

         return $qb->getQuery()->getResult();
    }
}

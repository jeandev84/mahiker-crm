<?php

namespace App\Repository;

use App\DTO\Request\UserListRequestDto;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository /* implements PasswordUpgraderInterface */
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

//    /**
//     * Used to upgrade (rehash) the user's password automatically over time.
//     */
//    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
//    {
//        if (!$user instanceof User) {
//            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
//        }
//
//        $user->setPassword($newHashedPassword);
//
//        $this->save($user, true);
//    }




      /**
       * @return float|int|mixed|string
       * @throws \Doctrine\ORM\NoResultException
       * @throws \Doctrine\ORM\NonUniqueResultException
      */
      public function getCountUsers()
      {
          return $this->createQueryBuilder('u')
                      ->select('count(u.id)')
                      ->getQuery()
                      ->getSingleScalarResult();
      }


      /**
       * @return \Doctrine\ORM\Query
      */
      public function findRecentUsersQuery(): \Doctrine\ORM\Query
      {
            $qb = $this->createQueryBuilder('u');

            return $qb->orderBy('u.createdAt', 'desc')->getQuery();
      }



      /*
      private function someQueryWithPagination(UserListRequestDto $requestDto)
      {
          $qb = $this->createQueryBuilder('u');

          $qb->orderBy('u.createdAt', 'desc')
              ->setFirstResult($requestDto->offset())
              ->setMaxResults($requestDto->getPerPage());

          return $qb->getQuery()->getResult();
      }
      */
}

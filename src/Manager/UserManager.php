<?php
namespace App\Manager;

use App\DataFixtures\UserFaker;
use App\DTO\Request\SaveUserRequestDto;
use App\DTO\Request\UserListRequestDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserManager
{

      /**
       * @param EntityManagerInterface $em
       * @param UserPasswordHasherInterface $passwordHasher
      */
      public function __construct(
          protected EntityManagerInterface $em,
          protected UserPasswordHasherInterface $passwordHasher
      )
      {
      }


      /**
       * @throws NonUniqueResultException
       * @throws NoResultException
      */
      public function getCountUsers()
      {
          /** @var UserRepository $repository */
          $repository = $this->em->getRepository(User::class);


          return $repository->getCountUsers();
      }



      /**
       * @return \Doctrine\ORM\Query
      */
      public function findUsersQuery()
      {
          /** @var UserRepository $repository */
          $repository = $this->em->getRepository(User::class);

          return $repository->findRecentUsersQuery();
      }




      /**
       * @return User[]
      */
      public function findUsers(): array
      {
           /** @var UserRepository $repository */
           $repository = $this->em->getRepository(User::class);

           return $repository->findAll();
      }




      /**
       * @param int $id
       * @return User|null
      */
      public function findUserById(int $id): ?User
      {
          /** @var UserRepository $repository */
          $repository = $this->em->getRepository(User::class);

          $user = $repository->find($id);

          if ($user === null) {
              return null;
          }

          return $user;
      }



      /**
       * @param User $user
       * @return User
      */
      public function saveUser(User $user): User
      {
          $this->em->persist($user);

          $this->em->flush();

          return $user;
      }



      /**
       * @param SaveUserRequestDto $requestDto
       * @return User
      */
      public function createUserFromRequestDTO(SaveUserRequestDto $requestDto): User
      {
           $user = new User();
           $user->setEmail($requestDto->getEmail());
           $user->setRoles(['ROLE_USER']);
           $user->setPassword($this->passwordHasher->hashPassword($user, $requestDto->getPlainPassword()));

           return $this->saveUser($user);
      }




      public function createFakeUsers()
      {
          $i = 0;

          foreach (UserFaker::getUsers() as $item) {

              $user = new User();
              $user->setEmail($item['email'])
                  ->setFullName($item['fullName'])
                  ->setRoles($item['roles'])
                  ->setPassword($this->passwordHasher->hashPassword($user, $item['password']));

              $this->em->persist($user);

              $i++;
          }

          $this->em->flush();

          return $i;
      }




      public function updateUserById(int $id) {}


      /**
       * @param User $user
       * @return bool
      */
      public function deleteUser(User $user)
      {
          $this->em->remove($user);

          $this->em->flush();

          return true;
      }




      /**
       * @param int $id
       * @return bool
      */
      public function deleteUserById(int $id): bool
      {
           if (! $user = $this->findUserById($id)) {
                return false;
           }

           return $this->deleteUser($user);
      }
}
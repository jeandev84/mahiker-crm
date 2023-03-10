<?php
namespace App\DTO\Request;

class SaveUserRequestDto
{

      /**
       * @var string
      */
      protected $email;


      /**
       * @var string
      */
      protected $password;


      /**
       * @param string $password
       * @return SaveUserRequestDto
      */
      public function setPlainPassword(string $password): static
      {
          $this->password = $password;

          return $this;
      }




      /**
       * @return string
      */
      public function getPlainPassword(): string
      {
          return $this->password;
      }



      /**
       * @param string $email
      */
      public function setEmail(string $email): void
      {
          $this->email = $email;
      }



      /**
       * @return string
      */
      public function getEmail(): string
      {
          return $this->email;
      }
}
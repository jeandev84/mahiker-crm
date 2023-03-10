<?php
namespace App\DTO\Response;

class UserListResponseDto
{


      /**
       * @var UserItemDto[]
      */
      protected $items = [];


     /**
      * @return UserItemDto[]
     */
     public function getItems(): array
     {
        return $this->items;
     }
}
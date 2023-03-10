<?php
namespace App\Factory;

use App\DTO\Request\UserListRequestDto;
use Symfony\Component\HttpFoundation\Request;

class UserListRequestDtoFactory
{

     /**
      * @param Request $request
      * @return UserListRequestDto
     */
     public static function createFromRequest(Request $request): UserListRequestDto
     {
           $requestDto = new UserListRequestDto();
           $requestDto->setPage($request->query->getInt('page', 1));
           $requestDto->setPerPage($request->query->getInt('perPage', 5));
           return $requestDto;
     }
}
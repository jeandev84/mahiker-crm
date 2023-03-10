<?php
namespace App\Service;

use App\Factory\UserListRequestDtoFactory;
use App\Manager\UserManager;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;



class UserService
{

     public function __construct(protected UserManager $userManager, protected PaginatorInterface $paginator)
     {
     }



     public function getUsersFromRequest(Request $request)
     {
         $requestDto = UserListRequestDtoFactory::createFromRequest($request);

         return $this->paginator->paginate(
             $this->userManager->findUsersQuery(),
             $requestDto->getPage(),
             $requestDto->getPerPage()
         );
     }
}
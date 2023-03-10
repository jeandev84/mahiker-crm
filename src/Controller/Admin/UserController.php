<?php
namespace App\Controller\Admin;

use App\Entity\User;
use App\Factory\UserListRequestDtoFactory;
use App\Form\UserFormType;
use App\Manager\UserManager;
use App\Repository\UserRepository;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/admin/users', name: 'admin.users.')]
class UserController extends AbstractController
{


     /**
      * @param UserManager $userManager
      * @param UserService $userService
     */
     public function __construct(protected UserManager $userManager, protected UserService $userService)
     {
     }



     /**
      * @param Request $request
      * @return Response
     */
     #[Route('/', name: 'list', methods: ['GET'])]
     public function list(Request $request): Response
     {
         return $this->render('admin/user/index.html.twig', [
             'items' => $this->userService->getUsersFromRequest($request)
         ]);
     }




     #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
     public function create(Request $request)
     {
         $user = new User();
         $form = $this->createForm(UserFormType::class, $user);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $this->userManager->saveUser($form->getData());
             return $this->redirectToRoute('admin.users.list', [], Response::HTTP_SEE_OTHER);
         }

         return $this->render('admin/user/create.html.twig', [
             'user' => $user,
             'form' => $form->createView(),
         ]);
     }



    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }




    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userManager->saveUser($form->getData());
            return $this->redirectToRoute('admin.users.list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }



    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->userManager->deleteUser($user);
        }

        return $this->redirectToRoute('admin.users.list', [], Response::HTTP_SEE_OTHER);
    }
}
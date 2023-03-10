<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{

    #[Route('/profile', name: 'user.profile', methods: ['GET'])]
    public function index(Request $request): Response
    {
        return $this->render('front/user/profile.html.twig', [
            'user' => $this->getUser()
        ]);
    }
}
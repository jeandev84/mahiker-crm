<?php
namespace App\Controller\Admin;

use App\Manager\JournalEventManager;
use App\Manager\UserManager;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/admin', name: 'admin.dashboard.')]
class DashboardController extends AbstractController
{

    public function __construct(protected UserManager $userManager, protected JournalEventManager $journalEventManager)
    {
    }



    /**
     * @return Response
     * @throws NoResultException
     * @throws NonUniqueResultException
    */
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
         return $this->render('admin/dashboard.html.twig', [
             'countUsers'  => $this->userManager->getCountUsers(),
             'countEvents' => $this->journalEventManager->getCountEvents()
         ]);
    }
}
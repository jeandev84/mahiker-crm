<?php
namespace App\Controller;

use App\Entity\JournalEvents;
use App\Manager\JournalEventManager;
use App\Manager\UserManager;
use App\Service\JournalEventService;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{

    public function __construct(protected JournalEventService $journalEventService)
    {
    }

    #[Route('/', name: 'home', methods: ['GET'])]
    public function homepage(Request $request): Response
    {
        return $this->render('front/index.html.twig', [
            'events' => $this->journalEventService->getEventsFromRequest($request)
        ]);
    }




    #[Route('/event/{id}', name: 'show.event', methods: ['GET'])]
    public function showEvent(JournalEvents $event): Response
    {
        return $this->render('front/event/show.html.twig', [
            'event' => $event
        ]);
    }
}
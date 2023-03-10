<?php
namespace App\Controller\Admin;

use App\Entity\JournalEvents;
use App\Form\JournalEventsType;
use App\Manager\JournalEventManager;
use App\Repository\JournalEventsRepository;
use App\Service\JournalEventService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/journal/events', name: 'admin.events.')]
class JournalEventsController extends AbstractController
{

    /**
     * @param JournalEventManager $journalEventManager
     * @param JournalEventService $journalEventService
    */
    public function __construct(
        protected JournalEventManager $journalEventManager,
        protected JournalEventService $journalEventService
    )
    {
    }


    #[Route('/', name: 'list', methods: ['GET'])]
    public function index(Request $request): Response
    {
        return $this->render('admin/events/index.html.twig', [
            'items' => $this->journalEventService->getEventsFromRequest($request)
        ]);
    }



    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $event = new JournalEvents();
        $form = $this->createForm(JournalEventsType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->journalEventManager->saveEvent($form->getData());
            return $this->redirectToRoute('admin.events.list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/events/create.html.twig', [
            'events' => $event,
            'form'   => $form,
        ]);
    }



    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(JournalEvents $event): Response
    {
        return $this->render('admin/events/show.html.twig', [
            'event' => $event,
        ]);
    }



    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JournalEvents $event): Response
    {
        $form = $this->createForm(JournalEventsType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->journalEventManager->saveEvent($form->getData());

            return $this->redirectToRoute('admin.events.list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/events/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }



    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, JournalEvents $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $this->journalEventManager->deleteEvent($event);
        }

        return $this->redirectToRoute('admin.events.list', [], Response::HTTP_SEE_OTHER);
    }
}

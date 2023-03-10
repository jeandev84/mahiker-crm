<?php
namespace App\Manager;

use App\Entity\JournalEvents;
use App\Repository\JournalEventsRepository;
use Doctrine\ORM\EntityManagerInterface;

class JournalEventManager
{

    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(protected EntityManagerInterface $em)
    {
    }




    public function getCountEvents()
    {
        /** @var JournalEventsRepository $repository */
        $repository = $this->em->getRepository(JournalEvents::class);

        return $repository->getCountEvents();
    }
    
    
    public function findEventsQuery()
    {
        /** @var JournalEventsRepository $repository */
        $repository = $this->em->getRepository(JournalEvents::class);

        return $repository->findRecentEventsQuery();
    }
    
    

    /**
     * @return JournalEvents[]
    */
    public function findEvents(): array
    {
        /** @var JournalEventsRepository $repository */
        $repository = $this->em->getRepository(JournalEvents::class);

        return $repository->findRecentEvents();
    }



    /**
     * @param JournalEvents $event
     * @return JournalEvents
    */
    public function saveEvent(JournalEvents $event): JournalEvents
    {
         $this->em->persist($event);

         $this->em->flush();

         return $event;
    }



    public function createEventFromArray(array $payload)
    {

    }




    /**
     * @param JournalEvents $event
     * @return bool
    */
    public function deleteEvent(JournalEvents $event): bool
    {
        $this->em->remove($event);

        $this->em->flush();

        return true;
    }



    public function deleteEventById(int $id)
    {

    }
}
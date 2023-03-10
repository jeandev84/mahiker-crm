<?php
namespace App\Service;

use App\Factory\JournalEventsRequestDtoFactory;
use App\Manager\JournalEventManager;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class JournalEventService
{
    public function __construct(protected JournalEventManager $journalEventManager, protected PaginatorInterface $paginator)
    {
    }


    /**
     * @param Request $request
     * @return PaginationInterface
    */
    public function getEventsFromRequest(Request $request)
    {
        $requestDto = JournalEventsRequestDtoFactory::createFromRequest($request);

        return $this->paginator->paginate(
            $this->journalEventManager->findEventsQuery(),
            $requestDto->getPage(),
            $requestDto->getPerPage()
        );
    }
}
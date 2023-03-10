<?php
namespace App\Factory;

use App\DTO\Request\JournalEventsRequestDto;
use Symfony\Component\HttpFoundation\Request;

class JournalEventsRequestDtoFactory
{
      public static function createFromRequest(Request $request)
      {
           $requestDto = new JournalEventsRequestDto();
           $requestDto->setPage($request->query->getInt('page', 1));
           $requestDto->setPerPage($request->query->getInt('perPage', 8));
           return $requestDto;
      }
}
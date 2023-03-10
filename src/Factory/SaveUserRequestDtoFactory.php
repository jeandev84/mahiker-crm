<?php
namespace App\Factory;

use App\DTO\Request\SaveUserRequestDto;
use Symfony\Component\HttpFoundation\Request;

class SaveUserRequestDtoFactory
{
      public static function createFromRequest(Request $request)
      {
           $requestDto = new SaveUserRequestDto();
      }
}
<?php
namespace App\DTO\Response;

use App\Entity\JournalEvents;

class UserItemDto
{
    private ?int $id = null;

    private ?string $email = null;


    /**
     * @var JournalEvents[]
    */
    private ?array $events;
}
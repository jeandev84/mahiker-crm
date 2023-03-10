<?php
namespace App\Entity\Traits;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait SoftDeletes
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $deletedAt = null;


    /**
     * @param \DateTimeInterface|null $deletedAt
    */
    public function setDeletedAt(?\DateTimeInterface $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }


    /**
     * @return \DateTimeInterface|null
    */
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }
}
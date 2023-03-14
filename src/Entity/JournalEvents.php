<?php
namespace App\Entity;

use App\Entity\Contract\HasMetaTimestampInterface;
use App\Entity\Traits\HasMetaTimestamp;
use App\Repository\JournalEventsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JournalEventsRepository::class)]
#[ORM\HasLifecycleCallbacks]
class JournalEvents implements HasMetaTimestampInterface
{

    use HasMetaTimestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;


    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;


    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?User $owner = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $startAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $endAt = null;


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }



    #[ORM\PrePersist]
    public function setCreatedAtValue(): static
    {
        $this->setCreatedAt(new \DateTimeImmutable());

        return $this;
    }



    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): static
    {
        $this->setUpdatedAt(new \DateTimeImmutable());

        return $this;
    }
}

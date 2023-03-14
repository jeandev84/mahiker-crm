<?php
namespace App\Entity;

use App\Entity\Contract\HasMetaTimestampInterface;
use App\Entity\Traits\HasMetaTimestamp;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`users`')]
#[ORM\HasLifecycleCallbacks]
class User implements UserInterface, PasswordAuthenticatedUserInterface, HasMetaTimestampInterface
{
    use HasMetaTimestamp;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;


    #[ORM\Column(length: 255)]
    private ?string $fullName = null;


    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: JournalEvents::class)]
    private Collection $events;


    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, JournalEvents>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(JournalEvents $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setOwner($this);
        }

        return $this;
    }

    public function removeEvent(JournalEvents $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getOwner() === $this) {
                $event->setOwner(null);
            }
        }

        return $this;
    }


    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

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

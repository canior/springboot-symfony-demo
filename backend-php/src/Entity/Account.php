<?php
namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account {
    #[ORM\Id]
    #[ORM\Column]
    #[Groups('account')]
    private int $id;

    #[ORM\Column]
    #[Groups('account')]
    private string $name;

    #[ORM\Column]
    #[Groups('account')]
    private string $status;

    #[ORM\OneToMany(mappedBy: 'account', targetEntity: Contact::class, fetch: 'LAZY')]
    #[ORM\OrderBy(['id' => 'ASC'])]
    #[Groups('account')]
    private Collection $contacts;

    public function __construct() {
        $this->contacts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Collection
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    /**
     * @param Collection $contacts
     */
    public function setContacts(Collection $contacts): void
    {
        $this->contacts = $contacts;
    }
}

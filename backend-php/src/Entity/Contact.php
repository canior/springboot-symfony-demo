<?php
namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact {
    #[ORM\Id]
    #[ORM\Column]
    #[Groups('account')]
    private int $id;

    #[ORM\Column(name: 'first_name')]
    #[Groups('account')]
    private string $firstName;

    #[ORM\Column(name: 'last_name')]
    #[Groups('account')]
    private string $lastName;

    #[ORM\Column(name: 'phone_number')]
    #[Groups('account')]
    private string $phoneNumber;

    #[ORM\Column(name: '`primary`', type: 'boolean')]
    #[Groups('account')]
    private bool $primary;

    #[ORM\ManyToOne(targetEntity: Account::class, inversedBy: "contacts")]
    #[ORM\JoinColumn(nullable: false)]
    private Account $account;

    public function __construct()
    {
        $this->primary = false;
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return bool
     */
    public function isPrimary(): bool
    {
        return $this->primary;
    }

    /**
     * @param bool $primary
     */
    public function setPrimary(bool $primary): void
    {
        $this->primary = $primary;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }
}

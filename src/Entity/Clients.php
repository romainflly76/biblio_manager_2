<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Clients
 *
 * @ORM\Table(name="clients", uniqueConstraints={@ORM\UniqueConstraint(name="phone", columns={"phone"}), @ORM\UniqueConstraint(name="mail", columns={"mail"})})
 * @ORM\Entity
 */
class Clients
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=false)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date", nullable=false)
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="adress", type="string", length=95, nullable=false)
     */
    private $adress;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=35, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=62, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=15, nullable=false)
     */
    private $phone;

    /**
     * @ORM\ManyToMany(targetEntity=Books::class, mappedBy="Clients")
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function toArray()
        {
               return [
                       'id' => $this->getId(),
                       'firstName' => $this->getFirstName(),
                       'lastName' => $this->getLastName(),
                       'birth_date' => $this->getBirthDate(),
                       'adress' => $this->getAdress(),
                       'city' => $this->getCity(),
                       'email' => $this->getMail(),
                       'phoneNumber' => $this->getPhone()
    ]; }

    /**
     * @return Collection|Books[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Books $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addClient($this);
        }

        return $this;
    }

    public function removeBook(Books $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removeClient($this);
        }

        return $this;
    }
  
}
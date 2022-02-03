<?php

namespace App\Entity;

use App\Repository\BorrowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BorrowRepository::class)
 */
class Borrow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Books::class, inversedBy="borrows")
     */
    private $Books;

    /**
     * @ORM\ManyToOne(targetEntity=Clients::class, inversedBy="borrows")
     */
    private $Clients;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date_loan;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $Date_rendered;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_rendred_max;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooks(): ?Books
    {
        return $this->Books;
    }

    public function setBooks(?Books $Books): self
    {
        $this->Books = $Books;

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->Clients;
    }

    public function setClients(?Clients $Clients): self
    {
        $this->Clients = $Clients;

        return $this;
    }

    public function getDateLoan(): ?\DateTimeInterface
    {
        return $this->Date_loan;
    }

    public function setDateLoan(\DateTimeInterface $Date_loan): self
    {
        $this->Date_loan = $Date_loan;

        return $this;
    }

    public function getDateRendered(): ?\DateTimeInterface
    {
        return $this->Date_rendered;
    }

    public function setDateRendered(?\DateTimeInterface $Date_rendered): self
    {
        $this->Date_rendered = $Date_rendered;

        return $this;
    }

    public function getDateRendredMax(): ?\DateTimeInterface
    {
        return $this->date_rendred_max;
    }

    public function setDateRendredMax(\DateTimeInterface $date_rendred_max): self
    {
        $this->date_rendred_max = $date_rendred_max;

        return $this;
    }
}

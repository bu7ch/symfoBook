<?php

namespace App\Entity;

use App\Repository\BorrowingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowingRepository::class)]
class Borrowing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $borrowedAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $returnedAt = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'borrowings')]
    private ?Book $book = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowedAt(): ?\DateTimeInterface
    {
        return $this->borrowedAt;
    }

    public function setBorrowedAt(\DateTimeInterface $borrowedAt): static
    {
        $this->borrowedAt = $borrowedAt;

        return $this;
    }

    public function getReturnedAt(): ?\DateTimeInterface
    {
        return $this->returnedAt;
    }

    public function setReturnedAt(?\DateTimeInterface $returnedAt): static
    {
        $this->returnedAt = $returnedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): static
    {
        $this->book = $book;

        return $this;
    }
}

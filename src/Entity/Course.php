<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
#[UniqueEntity('slug')]
class Course
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $name = null;

  #[ORM\Column(length: 255, unique: true)]
  private ?string $slug = null;

  #[ORM\Column]
  private ?int $amount = null;

  #[ORM\Column(length: 255)]
  private ?string $day = null;

  #[ORM\Column(type: Types::TEXT)]
  private ?string $Description = null;

  #[ORM\Column(type: Types::TIME_MUTABLE)]
  private ?\DateTimeInterface $start_time = null;

  #[ORM\Column(type: Types::TIME_MUTABLE)]
  private ?\DateTimeInterface $end_time = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getSlug(): ?string
  {
    return $this->slug;
  }

  public function setSlug(string $slug): self
  {
    $this->slug = $slug;

    return $this;
  }

  public function getAmount(): ?int
  {
    return $this->amount;
  }

  public function setAmount(int $amount): self
  {
    $this->amount = $amount;

    return $this;
  }

  public function getDay(): ?string
  {
    return $this->day;
  }

  public function setDay(string $day): self
  {
    $this->day = $day;

    return $this;
  }

  public function getDescription(): ?string
  {
    return $this->Description;
  }

  public function setDescription(string $Description): self
  {
    $this->Description = $Description;

    return $this;
  }

  public function getStartTime(): ?\DateTimeInterface
  {
    return $this->start_time;
  }

  public function setStartTime(\DateTimeInterface $start_time): self
  {
    $this->start_time = $start_time;

    return $this;
  }

  public function getEndTime(): ?\DateTimeInterface
  {
    return $this->end_time;
  }

  public function setEndTime(\DateTimeInterface $end_time): self
  {
    $this->end_time = $end_time;

    return $this;
  }
}

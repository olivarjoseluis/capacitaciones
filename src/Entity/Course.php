<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 255)]
  private ?string $name = null;

  #[ORM\Column(length: 255)]
  private ?string $slug = null;

  #[ORM\Column]
  private ?int $amount = null;

  #[ORM\Column(length: 255)]
  private ?string $day = null;

  #[ORM\Column(length: 255)]
  private ?string $start_time = null;

  #[ORM\Column(length: 255)]
  private ?string $end_time = null;

  #[ORM\Column(type: Types::TEXT)]
  private ?string $Description = null;

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

  public function getStartTime(): ?string
  {
    return $this->start_time;
  }

  public function setStartTime(string $start_time): self
  {
    $this->start_time = $start_time;

    return $this;
  }

  public function getEndTime(): ?string
  {
    return $this->end_time;
  }

  public function setEndTime(string $end_time): self
  {
    $this->end_time = $end_time;

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
}

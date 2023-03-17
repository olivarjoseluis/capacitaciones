<?php

namespace App\Entity;

use App\Repository\SubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionRepository::class)]
class Subscription
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\ManyToOne(inversedBy: 'subscriptions')]
  #[ORM\JoinColumn(nullable: false)]
  private ?User $user = null;

  #[ORM\ManyToOne(inversedBy: 'subscriptions')]
  #[ORM\JoinColumn(nullable: false)]
  private ?Course $course = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getUser(): ?User
  {
      return $this->user;
  }

  public function setUser(?User $user): self
  {
      $this->user = $user;

      return $this;
  }

  public function getCourse(): ?Course
  {
      return $this->course;
  }

  public function setCourse(?Course $course): self
  {
      $this->course = $course;

      return $this;
  }
}

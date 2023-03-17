<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Este email se encuentra registado.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
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
  private ?string $name = null;

  #[ORM\OneToMany(mappedBy: 'user_creator', targetEntity: Course::class, orphanRemoval: true)]
  private Collection $courses;

  #[ORM\OneToMany(mappedBy: 'user', targetEntity: Subscription::class)]
  private Collection $subscriptions;

  public function __construct()
  {
      $this->courses = new ArrayCollection();
      $this->subscriptions = new ArrayCollection();
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

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  /**
   * @return Collection<int, Course>
   */
  public function getCourses(): Collection
  {
      return $this->courses;
  }

  public function addCourse(Course $course): self
  {
      if (!$this->courses->contains($course)) {
          $this->courses->add($course);
          $course->setUserCreator($this);
      }

      return $this;
  }

  public function removeCourse(Course $course): self
  {
      if ($this->courses->removeElement($course)) {
          // set the owning side to null (unless already changed)
          if ($course->getUserCreator() === $this) {
              $course->setUserCreator(null);
          }
      }

      return $this;
  }
  public function __toString():string
  {
    return (string)$this->getName();
  }

  /**
   * @return Collection<int, Subscription>
   */
  public function getSubscriptions(): Collection
  {
      return $this->subscriptions;
  }

  public function addSubscription(Subscription $subscription): self
  {
      if (!$this->subscriptions->contains($subscription)) {
          $this->subscriptions->add($subscription);
          $subscription->setUser($this);
      }

      return $this;
  }

  public function removeSubscription(Subscription $subscription): self
  {
      if ($this->subscriptions->removeElement($subscription)) {
          // set the owning side to null (unless already changed)
          if ($subscription->getUser() === $this) {
              $subscription->setUser(null);
          }
      }

      return $this;
  }
}

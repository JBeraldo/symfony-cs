<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 *
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ORM\Cache(usage: 'NONSTRICT_READ_WRITE')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @var int|null
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $segment = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $username = null;
    /**
     * @var ArrayCollection|Collection
     */
    #[ORM\OneToMany(targetEntity: Experience::class, mappedBy: 'candidate',cascade: ['persist','remove','refresh'])]
    private Collection|ArrayCollection $experiences;
    /**
     * @var ArrayCollection|Collection
     */
    #[ORM\ManyToMany(targetEntity: Skill::class, mappedBy: 'users', cascade: ['persist','detach','refresh'])]
    private Collection|ArrayCollection $skills;

    /**
     *
     */
    public function __construct()
    {
        $this->experiences = new ArrayCollection();
        $this->skills = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return Collection
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    /**
     * @return void
     */
    public function setExperiences(Collection $experiences): void
    {
        $this->experiences = $experiences;
    }

    /**
     * @return $this
     */
    public function setEmail(string $email): static
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
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
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

    /**
     * @return $this
     */
    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return $this
     */
    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSegment(): ?string
    {
        return $this->segment;
    }

    /**
     * @return $this
     */
    public function setSegment(?string $segment): static
    {
        $this->segment = $segment;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return $this
     */
    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     *
     * @return bool
     */
    public function isCandidate(): bool
    {
        return in_array('ROLE_CANDIDATE',$this->getRoles());
    }

    /**
     *
     * @return bool
     */
    public function isCompany():bool
    {
        return in_array('ROLE_COMPANY',$this->getRoles());
    }

    /**
     * @return Collection
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    /**
     * @return void
     */
    public function setSkills(Collection $skills): void
    {
        $this->skills = $skills;
    }

}

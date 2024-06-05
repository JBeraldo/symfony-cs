<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Repository\SkillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
#[ORM\Entity(repositoryClass: SkillRepository::class)]
#[ORM\Table(name: '`skill`')]
#[ORM\Cache(usage: 'NONSTRICT_READ_WRITE')]
class Skill
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
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection|ArrayCollection
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'skills', cascade: ['all'])]
    #[ORM\JoinTable('users_skills')]
    private Collection $users;

    #[ORM\ManyToMany(targetEntity: Job::class, inversedBy: 'skills', cascade: ['all'])]
    #[ORM\JoinTable('jobs_skills')]
    private Collection $jobs;

    /**
     *
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->jobs = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @return void
     */
    public function setUsers(Collection $users): void
    {
        $this->users = $users;
    }

    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function setJobs(Collection $jobs): void
    {
        $this->jobs = $jobs;
    }

}

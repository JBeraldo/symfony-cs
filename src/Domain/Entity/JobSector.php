<?php

namespace App\Domain\Entity;

use App\Domain\Repository\JobSectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobSectorRepository::class)]
class JobSector
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private string $name;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private string $description;

    /**
     * @var ArrayCollection|Collection
     */
    #[ORM\OneToMany(targetEntity: Job::class, mappedBy: 'jobSector',cascade: ['persist','remove','refresh'])]
    private Collection|ArrayCollection $jobs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getJobs(): ArrayCollection|Collection
    {
        return $this->jobs;
    }

    public function setJobs(ArrayCollection|Collection $jobs): void
    {
        $this->jobs = $jobs;
    }
}

<?php

namespace App\Domain\Entity;

use App\Domain\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(length: 180)]
    private string $title;

    /**
     * @var string
     */
    #[ORM\Column(length: 180)]
    private string $description;

    /**
     * @var string
     */
    #[ORM\Column]
    private int $experience;

    #[ORM\Column]
    private float $minimumSalary;

    #[ORM\Column(nullable: true)]
    private ?float $maximum_salary = null;

    #[ORM\Column]
    private bool $active;

    #[ORM\ManyToOne(targetEntity: JobSector::class, inversedBy: 'jobs')]
    private JobSector $jobSector;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'jobs')]
    private User $company;

    /**
     * @var ArrayCollection|Collection
     */
    #[ORM\ManyToMany(targetEntity: Skill::class, mappedBy: 'jobs', cascade: ['persist','detach','refresh'])]
    private Collection|ArrayCollection $skills;

    /**
     *
     */
    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getExperience(): int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): void
    {
        $this->experience = $experience;
    }

    public function getMinimumSalary(): float
    {
        return $this->minimumSalary;
    }

    public function setMinimumSalary(float $minimumSalary): void
    {
        $this->minimumSalary = $minimumSalary;
    }

    public function getMaximumSalary(): ?float
    {
        return $this->maximum_salary;
    }

    public function setMaximumSalary(?float $maximum_salary): void
    {
        $this->maximum_salary = $maximum_salary;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getJobSector(): JobSector
    {
        return $this->jobSector;
    }

    public function setJobSector(JobSector $jobSector): void
    {
        $this->jobSector = $jobSector;
    }

    public function getSkills(): ArrayCollection|Collection
    {
        return $this->skills;
    }

    public function setSkills(ArrayCollection|Collection $skills): void
    {
        $this->skills = $skills;
    }

    public function getCompany(): User
    {
        return $this->company;
    }

    public function setCompany(User $company): void
    {
        $this->company = $company;
    }


}

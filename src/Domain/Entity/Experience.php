<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Repository\ExperienceRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
#[ORM\Entity(repositoryClass: ExperienceRepository::class)]
#[ORM\Cache(usage: 'NONSTRICT_READ_WRITE')]
class Experience
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
    private ?string $company_name = null;

    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?DateTimeInterface $start_date = null;

    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $end_date = null;

    /**
     * @var string|null
     */
    #[ORM\Column(length: 255)]
    private ?string $position = null;
    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'experiences')]
    private User $candidate;

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
    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    /**
     * @return $this
     */
    public function setCompanyName(string $company_name): static
    {
        $this->company_name = $company_name;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStartDate(): ?DateTimeInterface
    {
        return $this->start_date;
    }

    /**
     * @return $this
     */
    public function setStartDate(string $start_date): static
    {
        $this->start_date = new DateTime($start_date);

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndDate(): ?DateTimeInterface
    {
        return $this->end_date;
    }

    /**
     * @return $this
     */
    public function setEndDate(string $end_date): static
    {
        $this->end_date = new DateTime($end_date) ;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @return $this
     */
    public function setPosition(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return User
     */
    public function getCandidate(): User
    {
        return $this->candidate;
    }

    /**
     * @return void
     */
    public function setCandidate(User $candidate): void
    {
        $this->candidate = $candidate;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }


}

<?php

declare(strict_types = 1);

namespace App\Http\Resource;

class CandidateResource extends UserResource {
    private array $competencias;
    private array $experiencia;
    public function __construct(

    )
    {
        parent::__construct();
    }

    public function getCompetencias(): array
    {
        return $this->competencias;
    }

    public function setCompetencias(array $competencias): void
    {
        $this->competencias = $competencias;
    }

    public function getExperiencia(): array
    {
        return $this->experiencia;
    }

    public function setExperiencia(array $experiencia): void
    {
        $this->experiencia = $experiencia;
    }
}
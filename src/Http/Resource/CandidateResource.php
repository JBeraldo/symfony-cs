<?php

declare(strict_types = 1);

namespace App\Http\Resource;

class CandidateResource extends UserResource {
    private array $competencias = [];
    private array $experiencias = [];
    public function __construct()
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

    public function getExperiencias(): array
    {
        return $this->experiencias;
    }

    public function setExperiencias(array $experiencias): void
    {
        $this->experiencias = $experiencias;
    }


}
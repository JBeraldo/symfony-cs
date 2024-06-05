<?php

declare(strict_types=1);

namespace App\Http\Resource;

use App\Domain\Entity\JobSector;
use App\Http\Request\Request;

class JobResource implements Request
{
    public string $titulo;
    public string $descrição;
    public int $ramo_id;
    public int $experiencia;
    public float $salario_min;
    public ?float $salario_max;
    public ?array $competencias;
    public bool $ativo;
    public int $empresa_id;
    public JobSectorResource $ramo;

    public function __construct()
    {

    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getDescrição(): string
    {
        return $this->descrição;
    }

    public function setDescrição(string $descrição): void
    {
        $this->descrição = $descrição;
    }

    public function getRamoId(): int
    {
        return $this->ramo_id;
    }

    public function setRamoId(int $ramo_id): void
    {
        $this->ramo_id = $ramo_id;
    }

    public function getExperiencia(): int
    {
        return $this->experiencia;
    }

    public function setExperiencia(int $experiencia): void
    {
        $this->experiencia = $experiencia;
    }

    public function getSalarioMin(): float
    {
        return $this->salario_min;
    }

    public function setSalarioMin(float $salario_min): void
    {
        $this->salario_min = $salario_min;
    }

    public function getSalarioMax(): ?float
    {
        return $this->salario_max;
    }

    public function setSalarioMax(?float $salario_max): void
    {
        $this->salario_max = $salario_max;
    }

    public function getCompetencias(): ?array
    {
        return $this->competencias;
    }

    public function setCompetencias(?array $competencias): void
    {
        $this->competencias = $competencias;
    }

    public function isAtivo(): bool
    {
        return $this->ativo;
    }

    public function setAtivo(bool $ativo): void
    {
        $this->ativo = $ativo;
    }

    public function getEmpresaId(): int
    {
        return $this->empresa_id;
    }

    public function setEmpresaId(int $empresa_id): void
    {
        $this->empresa_id = $empresa_id;
    }

    public function getRamo(): JobSectorResource
    {
        return $this->ramo;
    }

    public function setRamo(JobSectorResource $ramo): void
    {
        $this->ramo = $ramo;
    }


}
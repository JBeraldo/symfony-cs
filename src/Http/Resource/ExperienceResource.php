<?php

namespace App\Http\Resource;
class ExperienceResource
{
    private int $id;
    private string $nome_empresa;
    private string $inicio;
    private ?string $fim = null;
    private string $cargo;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNomeEmpresa(): string
    {
        return $this->nome_empresa;
    }

    public function setNomeEmpresa(string $nome_empresa): void
    {
        $this->nome_empresa = $nome_empresa;
    }

    public function getInicio(): string
    {
        return $this->inicio;
    }

    public function setInicio(string $inicio): void
    {
        $this->inicio = $inicio;
    }

    public function getFim(): ?string
    {
        return $this->fim;
    }

    public function setFim(?string $fim): void
    {
        $this->fim = $fim;
    }

    public function getCargo(): string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): void
    {
        $this->cargo = $cargo;
    }
}
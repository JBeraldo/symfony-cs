<?php

namespace App\Http\Resource;

class JobSectorResource
{
    private int $id;
    private string $nome;

    private string $descrição;

    public function getDescrição(): string
    {
        return $this->descrição;
    }

    public function setDescrição(string $descrição): void
    {
        $this->descrição = $descrição;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }


}
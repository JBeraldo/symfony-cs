<?php

namespace App\Http\Resource;

class CompanyResource extends UserResource
{
    private string $ramo;
    private string $descricao;
    public function __construct(
    )
    {
        parent::__construct();
    }

    public function getRamo(): string
    {
        return $this->ramo;
    }

    public function setRamo(string $ramo): void
    {
        $this->ramo = $ramo;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }


}
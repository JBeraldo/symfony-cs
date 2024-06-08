<?php

declare(strict_types = 1);

namespace App\Http\Request\Job;

use App\Http\Request\Request;
use Symfony\Component\Validator\Constraints as Assert;

class CreateJobRequest implements Request {
    public function __construct(
        #[Assert\NotBlank(
            message: 'Título não deve ser nulo'
        )]
        #[Assert\Type(
            type: 'string',
            message: "Título deve ser texto"
        )]
        public string $titulo,
        #[Assert\Type(
            type: 'string',
            message: "Descrição deve ser texto"
        )]
        #[Assert\NotBlank(
            message: 'Descrição não deve ser nulo'
        )]
        public string $descricao,
        #[Assert\Type(
            type: 'int',
            message: "Ramo deve ser inteiro"
        )]
        #[Assert\NotBlank(
            message: 'Ramo não deve ser nulo'
        )]
        public int    $ramo_id,
        #[Assert\Type(
            type: 'int',
            message: "Experiência deve ser inteiro"
        )]
        #[Assert\NotBlank(
            message: 'Experiência não deve ser nula'
        )]
        public int    $experiencia,
        #[Assert\Type(
            type: 'float',
            message: "Salário minímo deve ser real"
        )]
        #[Assert\NotBlank(
            message: 'Salário minímo não deve ser nulo'
        )]
        public float $salario_min,
        #[Assert\Type(
            type: 'float',
            message: "Salário maximo deve ser real"
        )]
        public ?float $salario_max,
        #[Assert\All([
            new Assert\Collection([
                'fields' => [
                    'id' => new Assert\NotBlank(),
                    'nome' => [new Assert\NotBlank(), new Assert\Type('string')],
                ],
            ])
        ])]
        public ?array $competencias,
        #[Assert\Type(
            type: 'bool',
            message: "Ativo deve ser booleano"
        )]
        public bool $ativo,
    )
    {

    }
}
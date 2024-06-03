<?php

declare(strict_types = 1);

namespace App\Http\Request\User;

use App\Http\Request\EntityValidator\SkillValidator;
use App\Http\Request\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserRequest implements Request {
    public function __construct(
        #[Assert\NotBlank(
            message: 'Nome não deve ser nulo'
        )]
        #[Assert\Type(
            type: 'string',
            message: "Nome deve ser texto"
        )]
        #[Assert\Regex(
            pattern: "/^[a-z ,.'-]+$/i",
            message: 'Nome Inválido',
            match: true,
        )]
        public string $nome,
        #[Assert\Type(
            type: 'string',
            message: "Email deve ser texto"
        )]
        #[Assert\NotBlank(
            message: 'Email não deve ser nulo'
        )]
        #[Assert\Email(
            message: 'O email {{ value }} não é valido.',
        )]
        public string $email,
        public ?string $senha,
        #[Assert\All([
            new Assert\Collection([
                'fields' => [
                    'id' => new Assert\NotBlank(),
                    'nome' => [new Assert\NotBlank(), new Assert\Type('string')],
                ],
            ])
        ])]
        public ?array $competencias,
        #[Assert\All([
            new Assert\Collection([
                'fields' => [
                    "nome_empresa"=> [new Assert\NotBlank(), new Assert\Type('string')],
                    "inicio"=> [new Assert\NotBlank(), new Assert\Type('string')],
                    "fim"=> [],
                    "cargo"=> [new Assert\NotBlank(), new Assert\Type('string')],
                ],
                "allowExtraFields" => true
            ])
        ])]

        public ?array $experiencia,
        #[Assert\Type(
            type: 'string',
            message: "Ramo deve ser texto"
        )]
        #[Assert\Length(
            min: 3,
            minMessage: 'Seu ramo deve ter no mínimo 3 caractéres',
        )]
        public ?string $ramo,
        #[Assert\Length(
            min: 10,
            minMessage: 'Sua descrição deve ter no mínimo 10 caractéres',
        )]
        #[Assert\Type(
            type: 'string',
            message: "Descrição deve ser texto"
        )]
        public ?string $descricao
    )
    {

    }
}
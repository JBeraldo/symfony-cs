<?php

declare(strict_types = 1);

namespace App\Http\Request\Company;

use App\Http\Request\Request;
use Symfony\Component\Validator\Constraints as Assert;

class CreateCompanyRequest implements Request {
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
        #[Assert\Type(
            type: 'string',
            message: "Senha deve ser texto"
        )]
        #[Assert\NotBlank(
            message: 'Senha não deve ser nula'
        )]
        public string $senha,
        #[Assert\Type(
            type: 'string',
            message: "Ramo deve ser texto"
        )]
        #[Assert\NotBlank(
            message: 'Ramo não deve ser nulo'
        )]
        #[Assert\Length(
            min: 3,
            minMessage: 'Seu ramo deve ter no mínimo 3 caractéres',
        )]
        public string $ramo,
        #[Assert\Length(
            min: 10,
            minMessage: 'Sua descrição deve ter no mínimo 10 caractéres',
        )]
        #[Assert\Type(
            type: 'string',
            message: "Descrição deve ser texto"
        )]
        #[Assert\NotBlank(
            message: 'Descrição não deve ser nula'
        )]
        public string $descricao
    )
    {

    }
}
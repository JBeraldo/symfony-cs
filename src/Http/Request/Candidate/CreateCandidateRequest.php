<?php

namespace App\Http\Request\Candidate;

use Symfony\Component\Validator\Constraints as Assert;

class CreateCandidateRequest{
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
    )
    {

    }
}
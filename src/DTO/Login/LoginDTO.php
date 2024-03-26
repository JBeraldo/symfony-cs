<?php

namespace App\DTO\Login;
use Symfony\Component\Validator\Constraints as Assert;
readonly class LoginDTO
{
    public function __construct(
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
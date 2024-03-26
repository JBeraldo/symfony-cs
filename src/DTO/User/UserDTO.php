<?php

declare(strict_types=1);

namespace App\DTO\User;

readonly class UserDTO{

    public function __construct(
        public string  $username,
        public string  $email,
        public string  $password,
        public ?string $segment = null,
        public ?string $description = null,
    )
    {

    }
}
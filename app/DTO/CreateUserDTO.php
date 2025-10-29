<?php

namespace App\DTO;

final class CreateUserDTO
{
    public function __construct(
        public readonly string  $email,
        public readonly string $username,
        public readonly ?string $name
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            email:  $data['email'],
            username:  $data['username'],
            name:  $data['name'] ?? null
        );
    }
}

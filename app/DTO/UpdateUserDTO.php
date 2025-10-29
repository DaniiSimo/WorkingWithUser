<?php

namespace App\DTO;

use App\Models\User;

final class UpdateUserDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $username,
        public readonly User $user
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name:  $data['name'] ?? null,
            username:  $data['username'] ?? null,
            user: $data['user']
        );
    }
}

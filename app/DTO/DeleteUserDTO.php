<?php

namespace App\DTO;

use App\Models\User;

final class DeleteUserDTO
{
    public function __construct(
        public readonly User $user
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            user:  $data['user']
        );
    }
}

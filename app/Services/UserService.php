<?php

namespace App\Services;

use App\DTO\CreateUserDTO;
use App\DTO\DeleteUserDTO;
use App\DTO\GetUserDTO;
use App\DTO\UpdateUserDTO;
use App\Models\User;
use Illuminate\Support\Collection;

final class UserService
{
    public function add(CreateUserDTO $dto):User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'username' => $dto->username
        ]);
    }
    public function get(GetUserDTO $dto):User{
        return $dto->user;
    }
    public function update(UpdateUserDTO $dto):bool
    {
        $data = [];
        if(!is_null($dto->name))
            $data['name'] = $dto->name;
        if(!is_null($dto->username))
            $data['username'] = $dto->username;

        return $dto->user->fill($data)->save();
    }
    public function delete(DeleteUserDTO $dto):bool{
        return $dto->user->delete();
    }
}

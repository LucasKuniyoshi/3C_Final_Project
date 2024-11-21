<?php
namespace App\Domains\UserDomain\Services\Contracts;

use App\Domains\UserDomain\Models\User;

interface UserServiceInterface
{
    public function getAllUsers();

    public function getUserById(int $id): ?User;

    public function createUser(array $data): User;

    public function updateUser(int $id, array $data): ?User;

    public function deleteUser(int $id): bool;
}

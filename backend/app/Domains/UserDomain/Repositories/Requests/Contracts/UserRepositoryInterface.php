<?php
namespace App\Domains\UserDomain\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Domains\UserDomain\Models\User;

interface UserRepositoryInterface
{
    public function all(): Collection;

    public function findById(int $id): ?User;

    public function create(array $data): User;

    public function update(User $user, array $data): bool;

    public function delete(User $user): bool;
}

<?php
namespace App\Domains\UserDomain\Services;

use App\Domains\UserDomain\Models\User;
use App\Domains\UserDomain\Repositories\Contracts\UserRepositoryInterface;
use App\Domains\UserDomain\Services\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data): User
    {

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepository->create($data);
    }
    public function validateUserData(array $data, int $id = null): array
    {
        $rules = [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . ($id ?? ''),
            'password' => 'nullable|string|min:8|confirmed',
            'user_type' => 'sometimes|in:recruiter,candidate',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }

        return $validator->validated();
    }

    public function updateUser(int $id, array $data): ?User
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            return null;
        }


        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $this->userRepository->update($user, $data);

        return $user;
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            return false;
        }

        return $this->userRepository->delete($user);
    }
}

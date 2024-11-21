<?php
namespace App\Domains\UserDomain\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\UserDomain\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Domains\UserDomain\Validators\UserValidator;
use App\Domains\UserDomain\Services\Contracts\UserServiceInterface;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validated = UserValidator::validateCreate($request->all());


        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = UserValidator::validateUpdate($request->all(), $id);

        $user = User::findOrFail($id);


        $user->name = $validated['name'] ?? $user->name;
        $user->email = $validated['email'] ?? $user->email;
        $user->user_type = $validated['user_type'] ?? $user->user_type;


        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $deleted = $this->userService->deleteUser($id);

        if (!$deleted) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['message' => 'User deleted successfully']);
    }
}
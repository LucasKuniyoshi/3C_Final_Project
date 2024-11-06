<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    // Listar todos os usuários
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Exibir detalhes de um usuário específico
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Criar um novo usuário
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8', // Confirmação de senha
            'user_type' => 'required|in:recruiter,candidate', // Tipo de usuário
        ]);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // Atualizar um usuário existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'user_type' => 'in:recrutador,candidato',
        ]);

        $user = User::findOrFail($id);

        // Atualizar os campos
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->user_type = $request->user_type ?? $user->user_type;

        // Atualizar a senha apenas se for fornecida
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json($user);
    }

    // Excluir um usuário
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}

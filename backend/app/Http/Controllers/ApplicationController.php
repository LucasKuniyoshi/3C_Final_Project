<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // Listar todas as candidaturas
    public function index()
    {
        $applications = Application::with(['user', 'job'])->get();
        return response()->json($applications);
    }

    // Exibir detalhes de uma candidatura específica
    public function show($id)
    {
        $application = Application::with(['user', 'job'])->findOrFail($id);
        return response()->json($application);
    }

    // Criar uma nova candidatura
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Deve existir na tabela de usuários
            'job_id' => 'required|exists:jobs,id',   // Deve existir na tabela de vagas
            'name' => 'required|string|max:255',
            'recruiter_name' => 'required|string|max:255',
        ]);

        $application = Application::create([
            'user_id' => $request->user_id,
            'job_id' => $request->job_id,
            'name' => $request->name,
            'recruiter_name' => $request->recruiter_name,
        ]);

        return response()->json($application, 201);
    }

    // Atualizar uma candidatura existente
    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $request->validate([
            'user_id' => 'exists:users,id', // Deve existir na tabela de usuários
            'job_id' => 'exists:jobs,id',   // Deve existir na tabela de vagas
            'name' => 'string|max:255',
            'recruiter_name' => 'string|max:255',
        ]);

        $application->update($request->only(['user_id', 'job_id', 'name', 'recruiter_name']));

        return response()->json($application);
    }

    // Excluir uma candidatura
    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return response()->json(['message' => 'Application deleted successfully']);
    }
}

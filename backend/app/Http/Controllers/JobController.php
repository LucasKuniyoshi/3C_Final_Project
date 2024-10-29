<?php
namespace App\Http\Controllers;

use App\Models\Job;
// use App\Models\Company;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Listar todas as vagas
    public function index()
    {
        $jobs = Job::with('company')->get();
        return response()->json($jobs);
    }

    // Exibir detalhes de uma vaga
    public function show($id)
    {
        $job = Job::with('company')->findOrFail($id);
        return response()->json($job);
    }

    // Criar uma nova vaga
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'salary' => 'nullable|numeric',
            'employment_type' => 'required|in:full-time,part-time,contract,internship',
            'company_id' => 'required|exists:companies,id',
        ]);

        $job = Job::create($request->all());
        return response()->json($job, 201);
    }

    // Atualizar uma vaga existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'location' => 'string',
            'salary' => 'nullable|numeric',
            'employment_type' => 'in:full-time,part-time,contract,internship',
            'company_id' => 'exists:companies,id',
        ]);

        $job = Job::findOrFail($id);
        $job->update($request->all());
        return response()->json($job);
    }

    // Excluir uma vaga
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return response()->json(['message' => 'Job deleted successfully']);
    }
}

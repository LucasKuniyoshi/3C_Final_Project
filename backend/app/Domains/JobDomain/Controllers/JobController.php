<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Listar vagas do recrutador logado
    public function index(Request $request)
    {
        if (auth()->user()->user_type !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        // Filtra as vagas pelo recrutador logado e permite filtragem por categoria
        $query = Job::where('recruiter_id', auth()->id())->with('company');

        if ($request->has('departament')) {
            $query->where('departament', $request->departament);
        }

        $jobs = $query->get();
        return response()->json($jobs);
    }

    // Exibir detalhes de uma vaga
    public function show($id)
    {
        $job = Job::with('company')->findOrFail($id);
        return response()->json($job);
    }

    // Criar uma nova vaga (apenas para recrutadores)
    public function store(Request $request)
    {
        if (auth()->user()->user_type !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'salary' => 'nullable|numeric',
            'employment_type' => 'required|in:full-time,part-time,contract,internship',
            'company_id' => 'required|exists:companies,id',
            'departament' => 'required|in:technology,sales,marketing,human resources,financial'
        ]);

        // Cria a vaga e define o recrutador
        $job = Job::create(array_merge(
            $request->all(),
            ['recruiter_id' => auth()->id()]
        ));

        return response()->json($job, 201);
    }

    // Atualizar uma vaga existente (apenas para recrutadores)
    public function update(Request $request, $id)
    {
        if (auth()->user()->user_type !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $job = Job::where('id', $id)->where('recruiter_id', auth()->id())->firstOrFail();

        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'location' => 'string',
            'salary' => 'nullable|numeric',
            'employment_type' => 'in:full-time,part-time,contract,internship',
            'company_id' => 'exists:companies,id',
            'departament' => 'in:technology,sales,marketing,human resources,financial'
        ]);

        $job->update($request->all());
        return response()->json($job);
    }

    // Excluir uma vaga (apenas para recrutadores)
    public function destroy($id)
    {
        if (auth()->user()->user_type !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $job = Job::where('id', $id)->where('recruiter_id', auth()->id())->firstOrFail();
        $job->delete();

        return response()->json(['message' => 'Job deleted successfully']);
    }

    // Candidatar-se a uma vaga (apenas para candidatos)
    public function apply(Request $request, $id)
    {
        if (auth()->user()->user_type !== 'candidate') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $job = Job::findOrFail($id);

        // Verifica se o usuário já aplicou para essa vaga
        $existingApplication = Application::where('user_id', auth()->id())
                                          ->where('job_id', $job->id)
                                          ->first();

        if ($existingApplication) {
            return response()->json(['message' => 'You have already applied for this job.'], 400);
        }

        // Cria a aplicação
        $application = Application::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
            'name' => auth()->user()->name,
            'recruiter_name' => $job->company->name // Obtém o nome da empresa associada ao recrutador
        ]);

        return response()->json(['message' => 'Application submitted successfully', 'application' => $application], 201);
    }
}

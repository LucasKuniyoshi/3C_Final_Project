<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Listar vagas do recrutador logado
    public function index()
    {
        if (auth()->user()->user_type !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        // Filtrar as vagas apenas do recrutador logado
        $jobs = Job::where('recruiter_id', auth()->id())->with('company')->get();
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
        ]);

        // Criar a vaga e definir o recrutador
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
            'recruiter_name' => $job->company->name, // assumindo que a vaga tenha um recrutador associado
        ]);

        return response()->json(['message' => 'Application submitted successfully', 'application' => $application], 201);
    }
}

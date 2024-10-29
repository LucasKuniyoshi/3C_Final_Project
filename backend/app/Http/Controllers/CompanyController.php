<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // Listar todas as empresas
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    // Exibir detalhes de uma empresa
    public function show($id)
    {
        $company = Company::with('jobs')->findOrFail($id);
        return response()->json($company);
    }

    // Criar uma nova empresa
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $company = Company::create($request->all());
        return response()->json($company, 201);
    }

    // Atualizar uma empresa existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:companies,email,' . $id,
            'website' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());
        return response()->json($company);
    }

    // Excluir uma empresa
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully']);
    }
}

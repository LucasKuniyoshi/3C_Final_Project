<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'cnpj' => 'required|string|max:14',
        ]);

        // Criptografar a senha antes de salvar
        $validatedData['password'] = bcrypt($validatedData['password']);

        $company = Company::create($validatedData);

        return response()->json($company, 201);

        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'cnpj' => $request->cnpj,
            'description' => $request->description,
        ]);

        return response()->json($company, 201);
    }

    // Atualizar uma empresa existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:companies,email,' . $id,
            'password' => 'nullable|string|min:8',
            'cnpj' => 'digits:14|unique:companies,cnpj,' . $id,
            'description' => 'nullable|string',
        ]);

        $company = Company::findOrFail($id);

        $data = $request->only(['name', 'email', 'cnpj', 'description']);

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $company->update($data);
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

<?php

namespace App\Domains\CompanyDomain\Validators;

use Illuminate\Validation\Validators;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class CompanyValidator
{
    public function validateCreate(array $data)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:companies,email',
            'password' => 'required|string|min:6',
            'cnpj' => 'required|string|max:14|unique:companies,cnpj',
            'description' => 'nullable|string|max:255',
        ];

        $validator = FacadesValidator::make($data, $rules);

        if ($validator->fails()) {
            throw new \Exception("Validation failed: " . implode(", ", $validator->errors()->all()));
        }
    }

    public function validateUpdate(array $data)
    {
        $rules = [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:companies,email,' . $data['id'],
            'password' => 'nullable|string|min:6',
            'cnpj' => 'nullable|string|max:14|unique:companies,cnpj,' . $data['id'],
            'description' => 'nullable|string|max:255',
        ];

        $validator = FacadesValidator::make($data, $rules);

        if ($validator->fails()) {
            throw new \Exception("Validation failed: " . implode(", ", $validator->errors()->all()));
        }
    }
}

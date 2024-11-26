<?php

namespace App\Domains\JobDomain\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JobValidator
{
    public function validateJobCreation($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'request' => 'required|string', // Corrigido de 'requited' para 'required'
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'employment_type' => 'required|string|in:hybrid,remote,presential',
            'company_id' => 'required|exists:companies,id',
            'department' => 'required|string|in:technology,sales,marketing,human resources,financial',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }

    public function validateJobUpdate($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'request' => 'required|string', // Corrigido de 'requited' para 'required'
            'location' => 'sometimes|string|max:255',
            'salary' => 'sometimes|numeric|min:0',
            'employment_type' => 'sometimes|string|in:hybrid,remote,presential',
            'department' => 'sometimes|string|in:technology,sales,marketing,human resources,financial',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}

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
            'location' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'employment_type' => 'required|string|in:hybrid,remote,presential',
            'company_id' => 'required|exists:companies,id',
            'departament' => 'required|string|in:technology, sales, marketing, human resources, financial',
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
            'location' => 'sometimes|string|max:255',
            'salary' => 'sometimes|numeric|min:0',
            'employment_type' => 'sometimes|string|in:full_time,part_time,freelance,internship',
            'departament' => 'sometimes|string|in:technology, sales, marketing, human resources, financial',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}

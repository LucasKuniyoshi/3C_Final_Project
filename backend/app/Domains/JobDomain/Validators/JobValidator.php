<?php

namespace App\Domains\JobDomain\Validators;

use Illuminate\Http\Request;

class JobValidator
{
    public function validateJobCreation(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'salary' => 'nullable|numeric',
            'employment_type' => 'required|in:presential,homeoffice,hybrid',
            'company_id' => 'required|exists:companies,id',
            'departament' => 'required|in:technology,sales,marketing,human resources,financial'
        ]);
    }

    public function validateJobUpdate(Request $request)
    {
        return $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'location' => 'string',
            'salary' => 'nullable|numeric',
            'employment_type' => 'in:full-time,part-time,contract,internship',
            'company_id' => 'exists:companies,id',
            'departament' => 'in:technology,sales,marketing,human resources,financial'
        ]);
    }
}

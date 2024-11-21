<?php

namespace App\Domains\ApplicationDomain\Validators;

use Illuminate\Http\Request;

class ApplicationValidator
{
    public function validateApplicationCreation(Request $request)
    {
        return $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_id' => 'required|exists:jobs,id',
            'name' => 'required|string|max:255',
            'recruiter_name' => 'required|string|max:255',
        ]);
    }

    public function validateApplicationUpdate(Request $request)
    {
        return $request->validate([
            'user_id' => 'exists:users,id',
            'job_id' => 'exists:jobs,id',
            'name' => 'string|max:255',
            'recruiter_name' => 'string|max:255',
        ]);
    }
}

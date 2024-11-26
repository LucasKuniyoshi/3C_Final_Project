<?php

namespace App\Domains\JobDomain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domains\CompanyDomain\Models\Company;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'request',
        'location',
        'salary',
        'employment_type',
        'company_id',
        'departament',
        'recruiter_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

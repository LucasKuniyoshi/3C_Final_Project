<?php

namespace App\Domains\JobDomain\Models;

use App\Domains\UserDomain\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Domains\CompanyDomain\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'department',
        'recruiter_id',
    ];

    public function recruiter()
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    public function applications()
    {
        return $this->hasMany(\App\Domains\ApplicationDomain\Models\Application::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

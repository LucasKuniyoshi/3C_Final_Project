<?php

namespace App\Domains\ApplicationDomain\Models;

use App\Domains\JobDomain\Models\Job;
use App\Domains\UserDomain\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'name',
        'recruiter_name',
        'additional_info',
        'resume_path',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

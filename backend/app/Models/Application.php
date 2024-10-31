<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'name',
        'recruiter_name',
    ];


    public function jobApplications()
    {
        return $this->hasMany(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function applicationsReceived()
    {
        return $this->hasMany(Application::class);
    }


    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}

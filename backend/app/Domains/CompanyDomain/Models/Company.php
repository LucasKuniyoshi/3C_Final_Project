<?php

namespace App\Domains\CompanyDomain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cnpj',
        'description',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


    public function jobs()
    {
        return $this->hasMany(\App\Domains\JobDomain\Models\Job::class);
    }


    public function hasJobs(): bool
    {
        return $this->jobs()->count() > 0;
    }
}

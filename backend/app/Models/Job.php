<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'salary',
        'employment_type',
        'company_id',
        'departament',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

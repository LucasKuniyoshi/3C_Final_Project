<?php
namespace App\Domains\UserDomain\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


    public const USER_TYPES = [
        'RECRUITER' => 'recruiter',
        'CANDIDATE' => 'candidate',
    ];


    public function isRecruiter(): bool
    {
        return $this->user_type === self::USER_TYPES['RECRUITER'];
    }


    public function isCandidate(): bool
    {
        return $this->user_type === self::USER_TYPES['CANDIDATE'];
        return $this->belongsToMany(User::class, 'job_applications', 'job_id', 'candidate_id');
    }



    public function scopeByType($query, string $type)
    {
        return $query->where('user_type', $type);
    }
}

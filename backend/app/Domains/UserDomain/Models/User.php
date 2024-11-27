<?php
namespace App\Domains\UserDomain\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Domains\CompanyDomain\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'company_id',
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
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('user_type', $type);
    }
}

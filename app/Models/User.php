<?php

namespace App\Models;

use App\Models\Contracts\IScopeFilter;
use App\Models\FormFields\UserFields;
use App\Models\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements IScopeFilter
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    protected $fillable = [
        'code',
        'complete_name',
        'email',
        'password',
        'phone',
        'gender',
        'photo',
        'birthday',
        'status',
        'verified',
        'verification_token',
        'email_verified_at'
    ];

    public array $allowedSorts = ['id', 'code', 'complete_name', 'email'];

    public function isVerified(): bool
    {
        return $this->verified;
    }

    public static function generateVerificationToken(): string
    {
        return Str::random(UserFields::VERIFICATION_TOKEN_LENGTH);
    }

    public function scopeFilter(Builder $query, array $params = []): Builder
    {
        if (empty($params)) {
            return $query;
        }

        if (isset($params['code']) && trim($params['code']) !== '') {
            $query->orWhere('code', 'LIKE', "%${params['code']}%");
        }
        if (isset($params['completeName']) && trim($params['completeName']) !== '') {
            $query->orWhere('completeName', 'LIKE', "%${params['completeName']}%");
        }
        if (isset($params['email']) && trim($params['email']) !== '') {
            $query->orWhere('email', 'LIKE', "%${params['email']}%");
        }

        return $query;
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function academic(): HasOne
    {
        return $this->hasOne(Academic::class);
    }

    public function external(): HasOne
    {
        return $this->hasOne(External::class);
    }

    public function donations(): BelongsToMany
    {
        return $this->belongsToMany(Donation::class)->withTimestamps();
    }
}

<?php

namespace App\Models;

use App\Models\Constants\UserFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'paternal_surname',
        'maternal_surname',
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

    public static function generateVerificationToken(): string
    {
        return Str::random(UserFields::VERIFICATION_TOKEN_LENGTH);
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * NOTE: "role", "google_id" and the verification columns are NOT here on
     * purpose, so nobody can send them through a form. We set them in the
     * controllers instead.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /** @var list<string> */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'email_verified_at'            => 'datetime',
            'verification_code_expires_at' => 'datetime',
            'verification_attempts'        => 'integer',
            'password'                     => 'hashed',
        ];
    }

    // One place to check for admin (works for 'ADMIN' or 'admin')
    public function isAdmin(): bool
    {
        return strtoupper((string) $this->role) === 'ADMIN';
    }
}
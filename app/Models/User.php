<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'userType',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function helpTickets() :HasMany
    {
        return $this->hasMany(HelpTickets::class, 'createdBy', 'id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'userID', 'id');
    }

    public function isAdmin()
    {
        if($this->userType == 'Admin')
        {
            return true;
        }

        return false;
    }

    public function isTutor()
    {
        if($this->userType == 'Tutor')
        {
            return true;
        }

        return false;
    }
}

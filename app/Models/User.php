<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
        'photo',
        'user_type',
        'identification_number',
        'phone',
        'address',
        'province',
        'city',
        'district',
        'village',
        'postal_code',
        'job_title',
        'identity_file_path',
        'identity_file_path_2',
        'identity_file_path_3',
        'identity_file_path_4',
        'identity_file_path_5',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function informationRequests()
    {
        return $this->hasMany(InformationRequest::class);
    }
    public function objections()
    {
        return $this->hasMany(Objection::class);
    }
}

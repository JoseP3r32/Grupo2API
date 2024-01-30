<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;  
use Illuminate\Contracts\Auth\MustVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens; 

    protected $primaryKey = "id";
    public $incrementing = true;
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'email_confirmed',
        'actived',
        'type',
        'code',
        'password',
        'remember_token',
        'deleted'
    ];
    public $timestamps = true;
    protected $table = 'users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed', // Esta línea puede ser innecesaria ya que Laravel automáticamente encripta las contraseñas.
    ];

    public function markEmailAsVerified()
    {
        $this->forceFill([
            'email_verified_at' => now(),
        ])->save();
    }

}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function advert() {
        return $this->hasMany(Adverisements::class, 'UserID', 'AdID');
    }

    protected $fillable = [
        'username',
        'email',
        'password',
        'UserPhoto'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'Users';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

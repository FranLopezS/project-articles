<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
// use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}

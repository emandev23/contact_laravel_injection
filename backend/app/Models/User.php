<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable , HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Include role_id as a fillable attribute
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship to the Role model.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    protected static function newFactory()
    {
        return \Database\Factories\UserFactory::new();
    }

   

}

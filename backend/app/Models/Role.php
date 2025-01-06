<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    /**
     * Relationship to the User model.
     */
    public function users()
    {
        return $this->hasMany(User::class); // A role can have many users
    }

    /**
     * Relationship to the Permission model.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_has_permission'); // Adjust pivot table name if needed
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];

    /**
     * Relationship to the Role model.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_has_permission'); // Adjust pivot table name if needed
    }
}

<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Authenticatable
{
    protected $guarded = [];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole(Role $role)
    {
        $this->roles()->save($role);
    }
    public function showStatus()
    {
        return $this->status == 1 ? 'Active':"Forbidden";
    }

    public function isSuperAdmin()
    {
        $superAdminRole = Role::where('name','super_admin')->first();
        return $this->roles->contains($superAdminRole);

    }
}

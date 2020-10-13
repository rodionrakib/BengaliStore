<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable 
{
    use HasRoles;


    protected $guarded = [];



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

<?php

namespace App\Policies;

use App\Models\Employee;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the employee.
     *
     * @param  \App\Models\Employee  $user
     * @param  \App\Models\Employee  $employee
     * @return mixed
     */
    public function update(Employee $user, Employee $employee)
    {
        return $user->id == $employee->id ;
        // himself or if he have admin role 
    }

}

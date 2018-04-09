<?php

namespace App\Policies;

use App\User;
use App\staff;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the staff.
     *
     * @param  \App\User  $user
     * @param  \App\staff  $staff
     * @return mixed
     */
    public function update(User $user, staff $staff)
    {
         return ($user->staff_id == $staff->id || $user->hasRole('admin') ) ? true :false;
    }

}

<?php

namespace App\Policies;

use App\User;
use App\mission;
use Illuminate\Auth\Access\HandlesAuthorization;

class MissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the mission.
     *
     * @param  \App\User  $user
     * @param  \App\mission  $mission
     * @return mixed
     */
    public function view(User $user, mission $mission)
    {
        //
    }

    /**
     * Determine whether the user can create missions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the mission.
     *
     * @param  \App\User  $user
     * @param  \App\mission  $mission
     * @return mixed
     */
    public function update(User $user, mission $mission)
    {
        //
    }

    /**
     * Determine whether the user can delete the mission.
     *
     * @param  \App\User  $user
     * @param  \App\mission  $mission
     * @return mixed
     */
    public function delete(User $user, mission $mission)
    {
        //
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/8
 * Time: 15:32
 */

namespace App\Observers;


use App\User;

class UserObserver
{
    public function updated(User $user)
    {
        if ($user->isDirty(['name'])){
            $user->staff()->update([
                'name' => $user->name
            ]);
        }

    }
}
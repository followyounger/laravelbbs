<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    public function update(User $currentUser, User $user)
    {
        //只有自己才能修改自己
        return $currentUser->id === $user->id;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $currentuser, User $user)
    {
        return $currentuser->institution_id == $user->institution_id;
    }
    public function destroy(User $currentuser, User $user)
    {
        return $currentuser->institution_id == $user->institution_id;
    }
}

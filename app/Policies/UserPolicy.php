<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    /**
     * Determine whether the user can create models.
     * The policy always returns a boolean. Whether the user can or can not do something.
     */
    public function create(User $user): bool
    {
        //Dear policy, please return true if the logged in user's email is ...
        return $user->email === 'jedan@gmail.com';
    }

    /**
     * Here we deal with a situation when one logged in user edits the data of other users in the app.
     * 
     * User $user = current user, logged in. This user may have or may not have right to edit users.
     * User $model = the user that will be edited.
     * In real life, when we have a bussiness logic which user can edit which user, the we would
     * use these two arguments. Here, we do not have this bussiness logic. So the user arguments
     * are not used.
     * 
     */
    public function edit(User $user, User $model): bool
    {
        /**
         * Since we do not have a real logic how to decide how can and who can't edit users, we will
         * here use a random number converted to boolean
         */
        return (bool) mt_rand(0,1);
    }

}

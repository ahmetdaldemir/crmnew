<?php

namespace App\Policies;

use App\Models\Transfer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransferPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function index(User $user)
    {
        dd("Orada");
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
         if ($user->can('view-all-dispatches')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Transfer $transfer)
    {
        dd("Burada");
        if ($user->can('view-all-dispatches')) {
            return true;
        }

        // visitors cannot view unpublished items
        if ($user === null) {
            return false;
        }

        // authors can view their own unpublished posts
        return $user->id == $transfer->user_id;

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Transfer $transfer)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Transfer $transfer)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Transfer $transfer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Transfer $transfer)
    {
        //
    }
}

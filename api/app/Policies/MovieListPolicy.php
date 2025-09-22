<?php

namespace App\Policies;

use App\Models\MovieList;
use App\Models\User;

class MovieListPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MovieList $movieList): bool
    {
        return $movieList->is_public ?? true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MovieList $movieList): bool
    {
        return $user->is_admin || $user->id === $movieList->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MovieList $movieList): bool
    {
        return $user->is_admin || $user->id === $novieList->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MovieList $movieList): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MovieList $movieList): bool
    {
        return false;
    }
}

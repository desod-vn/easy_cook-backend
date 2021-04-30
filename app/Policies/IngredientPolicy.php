<?php

namespace App\Policies;

use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        //
        return true;
    }

    public function view(User $user, Ingredient $ingredient)
    {
        //
        return true;
    }

    
    public function create(User $user)
    {
        //
        return false;
    }

    public function update(User $user, Ingredient $ingredient)
    {
        //
        return false;
    }

    public function delete(User $user, Ingredient $ingredient)
    {
        //
        return false;
    }
    public function restore(User $user, Ingredient $ingredient)
    {
        return false;
    }

    public function forceDelete(User $user, Ingredient $ingredient)
    {
        return false;
    }
}

<?php

namespace App\Policies;

use App\Models\Category;
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

    public function view(User $user, Category $category)
    {
        //
        return true;
    }

    
    public function create(User $user)
    {
        //
        return false;
    }

    public function update(User $user, Category $category)
    {
        //
        return false;
    }

    public function delete(User $user, Category $category)
    {
        //
        return false;
    }
    public function restore(User $user, Category $category)
    {
        return false;
    }

    public function forceDelete(User $user, Category $category)
    {
        return false;
    }
}

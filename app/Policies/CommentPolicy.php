<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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

    public function view(User $user, Comment $comment)
    {
        //
        return true;
    }

    
    public function create(User $user)
    {
        //
        return true;
    }

    public function update(User $user, Comment $comment)
    {
        //
        return false;
    }

    public function delete(User $user, Comment $comment)
    {
        //
        return false;
    }
    public function restore(User $user, Comment $comment)
    {
        return false;
    }

    public function forceDelete(User $user, Comment $comment)
    {
        return false;
    }
}

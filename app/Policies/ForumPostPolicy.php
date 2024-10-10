<?php

namespace App\Policies;

use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, ForumPost $forumPost)
    {
        return $user->id === $forumPost->user_id;
    }

    public function delete(User $user, ForumPost $forumPost)
    {
        return $user->id === $forumPost->user_id;
    }
}
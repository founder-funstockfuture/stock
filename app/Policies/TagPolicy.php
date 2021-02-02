<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tag;

class TagPolicy extends Policy
{
    public function own(User $user, Tag $tags)
    {
        return $tags->user_id == $user->id;
    }

}

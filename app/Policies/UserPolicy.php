<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // 第一個參數是目前登入者，第二個參數是該頁面或動作有權限的使用者
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
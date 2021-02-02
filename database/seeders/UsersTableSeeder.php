<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 生成數據集合
        User::factory()->count(10)->create();

        // 單獨處理第一個用戶的數據
        $user = User::find(1);
        $user->name = 'Jim';
        $user->email = 'freecelestial@gmail.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->save();
        
        // 初始化用戶角色，將 1 號用戶指派爲『站長』
        $user->assignRole('Founder');

        // 將 2 號用戶指派爲『管理員』
        //$user = User::find(2);
        //$user->assignRole('Maintainer');

    }
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class SyncUserActivedAt extends Command
{
    protected $signature = 'stock:sync-user-actived-at';
    protected $description = '將用戶最後登錄時間從 Redis 同步到數據庫中';

    public function handle(User $user)
    {
        $user->syncUserActivedAt();
        $this->info("同步成功！");
    }
}
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMobileToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->unique()->nullable()->comment('手機號碼')->after('last_actived_at');
            $table->timestamp('mobile_verified_at')->nullable()->comment('手機驗證時間')->after('mobile');
            $table->boolean('is_blocked')->default(0)->comment('是否封鎖')->after('remember_token');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile');
            $table->dropColumn('mobile_verified_at');
            $table->dropColumn('is_blocked');
        });
    }
}
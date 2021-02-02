<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannedToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('mobile_password_reset_times')->unsigned()->default(0)->after('is_blocked')->comment('簡訊忘記密碼次數');
            $table->text('block_reason')->nullable()->after('mobile_password_reset_times')->comment('封鎖原因');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile_password_reset_times');
            $table->dropColumn('block_reason');

        });
    }
}
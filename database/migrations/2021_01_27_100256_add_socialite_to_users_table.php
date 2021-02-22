<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialiteToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider_id')->nullable()->after('password')->index();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //$table->dropColumn('provider_id');
        });
    }
}
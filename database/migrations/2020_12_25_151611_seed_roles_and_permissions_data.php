<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    public function up()
    {
        // 需清除緩存，否則會報錯
        app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // 進階會員
        Permission::create(['name' => 'vip_member']);
        // 文章管理者
        Permission::create(['name' => 'manage_contents']);
        // 站長(暫無特殊權限)
        Permission::create(['name' => 'edit_settings']);

        // 創建站長角色，並賦予權限
        $founder = Role::create(['name' => 'Founder']);
        $founder->givePermissionTo('vip_member');
        $founder->givePermissionTo('manage_contents');
        $founder->givePermissionTo('edit_settings');

        // 創建管理員角色，並賦予權限
        $maintainer = Role::create(['name' => 'Maintainer']);
        $maintainer->givePermissionTo('manage_contents');
    }

    public function down()
    {
        // 需清除緩存，否則會報錯
        app(Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // 清空所有數據表數據
        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}
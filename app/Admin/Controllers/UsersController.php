<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsersController extends AdminController
{

    protected $title = '會員';

    protected function grid()
    {
        $grid = new Grid(new User);

        // 創建一個列名爲 ID 的列，內容是用戶的 id 字段
        $grid->id('ID');

        // 創建一個列名爲 用戶名 的列，內容是用戶的 name 字段。下面的 email() 和 created_at() 同理
        $grid->name('會員名');

        $grid->email('email 信箱');

        $grid->email_verified_at('已驗證 email')->display(function ($value) {
            return $value ? '是' : '否';
        });


        
        $grid->mobile('手機號碼');
        $grid->mobile_verified_at('已驗證 mobile')->display(function ($value) {
            return $value ? '是' : '否';
        });
        


        $grid->mobile_password_reset_times('簡訊重設密碼次數');


        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
        ];
        $grid->is_blocked('是否封鎖')->switch($states)->sortable();

        $grid->column('block_reason')->editable();

        $grid->created_at('註冊時間');

        // 不在頁面顯示 `新建` 按鈕，因爲我們不需要在後臺新建用戶
        $grid->disableCreateButton();
        // 同時在每一行也不顯示 `編輯` 按鈕
        $grid->disableActions();

        $grid->tools(function ($tools) {
            // 禁用批量刪除按鈕
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        $grid->filter(function($filter){

            // 去掉預設的id過濾器
            $filter->disableIdFilter();
        
            // 在這裡新增欄位過濾器
            $filter->like('name', '使用者名稱');
            $filter->like('email', '郵箱');

        
        });




        return $grid;
    }


    protected function form()
    {
        $form = new Form(new User);

        $form->switch('is_blocked', '管理者封鎖');
        $form->number('mobile_password_reset_times', '簡訊忘記密碼次數');
        $form->text('block_reason', '封鎖原因');


        return $form;
    }    
}

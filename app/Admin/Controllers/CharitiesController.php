<?php

namespace App\Admin\Controllers;

use App\Models\Charity;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class CharitiesController extends AdminController
{
    protected $title = '慈善機構';


    protected function grid()
    {
        $grid = new Grid(new Charity);

        $grid->model()->orderBy('created_at', 'desc');
        $grid->id('ID')->sortable();
        $grid->love_name('名稱')->editable();
        $grid->love_code('代碼')->editable();

        // 設定text、color、和儲存值
        $states = [
            'On'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
            'Off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
        ];
        $grid->column('enabled', '啟用')->switch($states);
		
        $grid->created_at('建立時間')->sortable();
        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        $grid->filter(function($filter){

            // 去掉預設的id過濾器
            $filter->disableIdFilter();
        
            // 在這裡新增欄位過濾器
            $filter->like('love_name', '名稱');
            $filter->like('love_code', '代碼');
        
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Charity);

        $form->display('id', 'ID');
        $form->text('love_name', '慈善機構名稱')->rules('required');
        $form->text('love_code', '慈善機構代碼')
        ->creationRules(['required', 'min:3', "unique:charities"])
        ->updateRules(['required', "unique:charities,love_code,{{love_code}}"]);

        $states = [
            "on" => ["value" => 1, "text" => "是", "color" => "success"],
            "off" => ["value" => 0, "text" => "否", "color" => "danger"],
        ];
        $form->switch('enabled', '顯示')->states($states)->default('1');

        $form->tools(function (Form\Tools $tools) {

            // 去掉`列表`按钮
            //$tools->disableList();
        
            // 去掉`删除`按钮
            //$tools->disableDelete();
        
            // 去掉`查看`按钮
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            // 去掉`檢視`checkbox
            $footer->disableViewCheck();
        
            // 去掉`繼續編輯`checkbox
            $footer->disableEditingCheck();
        
            // 去掉`繼續建立`checkbox
            $footer->disableCreatingCheck();
        
        });


        return $form;
    }
}

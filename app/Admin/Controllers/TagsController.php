<?php

namespace App\Admin\Controllers;

use App\Models\Tag;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Models\User;


class TagsController extends AdminController
{
    protected $title = '標籤管理';


    protected function grid()
    {
        $grid = new Grid(new Tag);

        $grid->model()->orderBy('id', 'desc');
        //$grid->user_id('user ID');
        $grid->column('user.name', '會員名稱');
        $grid->tag_name('標籤名稱');
		
        $grid->created_at('建立時間')->sortable();

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableEdit();
        });

        $grid->filter(function($filter){

            // 去掉預設的id過濾器
            $filter->disableIdFilter();
        
            // 在這裡新增欄位過濾器
            $filter->like('user.name', '會員名稱');
            $filter->like('tag_name', '標籤名稱');
        
        });

        return $grid;
    }


    protected function form()
    {
        $form = new Form(new Tag);

        $form->select('user_id', '會員 Email')->options(User::all()->pluck('email', 'id'))->rules('required');
        $form->text('tag_name', '標籤名稱')->rules('required');

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

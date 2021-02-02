<?php

namespace App\Admin\Controllers;

use App\Models\VideoCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;


class VideoCategoriesController extends AdminController
{
    protected $title = '影片分類管理';


    protected function grid()
    {
        $grid = new Grid(new VideoCategory);

        $grid->model()->orderBy('id', 'desc');
        $grid->id('ID');
        $grid->column('name', '名稱');
        $grid->description('描述');
		
        $grid->created_at('建立時間')->sortable();

        $grid->actions(function ($actions) {
            $actions->disableView();
        });

        $grid->disableFilter();
        $grid->quickSearch('name','description');

        return $grid;
    }


    protected function form()
    {
        $form = new Form(new VideoCategory);

        $form->text('name', '名稱')->rules('required');
        $form->text('description', '描述')->rules('required');

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

<?php

namespace App\Admin\Controllers;

use App\Models\Topic;
use App\Models\Reply;
use App\Models\TopicCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
//use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class TopicsController extends AdminController
{
    protected $title = '文章';

    protected function grid()
    {
        $grid = new Grid(new Topic);

        $grid->id('ID')->sortable();
        $grid->column('category.name','分類')->width(80);
        $grid->title('標題')->width(150);
        $grid->excerpt('摘要')->limit(100)->width(150);

        $grid->column('is_show','是否上架')->using([
            0 => '否',
            1 => '是',
        ], '未知')->dot([
            0 => 'warning',
            1 => 'success',
        ], 'danger');

        $grid->column('on_sale','需付費')->using([
            0 => '否',
            1 => '是',
        ], '未知')->dot([
            0 => 'warning',
            1 => 'success',
        ], 'danger');

        $grid->coin('購買金額')->sortable();

        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'primary'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'default'],
        ];
        $grid->is_blocked('管理者封鎖')->switch($states)->sortable();
        $grid->published_at('發佈時間');

        // 可擴展
        $grid->column('reply_count', '留言數')->modal('留言',function ($model) {
            $replies = $model->replies()->take(20)->get()->map(function ($reply) {
                return array_merge(['name'=>$reply->user->name,'email'=>$reply->user->email],
                    $reply->only(['content', 'created_at','id']));
            });
    
            return new Table(['留言者', 'Email', '內容', '留言時間', '留言 ID'], $replies->toArray());
        })->sortable();


        $grid->view_count('閱覽數')->sortable();
        $grid->pay_count('付費數')->sortable();

        $grid->actions(function ($actions) {
            $actions->disableView();
            //$actions->disableDelete();
        });
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
            $filter->equal('category_id', '分類')->select(TopicCategory::all()->pluck('name', 'id'));

            $filter->like('title', '文章名稱');
            $filter->like('excerpt', '摘要');
            $filter->like('body', '內容');

            $filter->equal('is_show','是否上架')->radio([
                ''   => '全部',
                0    => '未上架',
                1    => '上架',
            ]);
            $filter->equal('on_sale','需付費')->radio([
                ''   => '全部',
                0    => '否',
                1    => '是',
            ]);
            $filter->equal('is_blocked','管理者封鎖')->radio([
                ''   => '全部',
                0    => '否',
                1    => '是',
            ]);
        
        });

        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Topic);

        // 創建一個輸入框
        $form->text('title', '標題')->rules('required');

        // 富文本編輯器
        $form->UEditor('excerpt', '摘要')->rules('required');
        $form->UEditor('body', '內容')->rules('required');


        $form->switch('is_show', '是否上架');
        $form->switch('on_sale', '需付費');
        $form->switch('is_blocked', '管理者封鎖');

        $form->number('view_count', '閱覽數');
        $form->number('coin', '購買金額');

        $form->hasMany('replies', '留言', function (Form\NestedForm $form) {
            $form->display('id', 'ID');
            //$form->display('user.name', '留言者');
            $form->textarea('content', '內容')->readonly();

        });

        $form->tools(function (Form\Tools $tools) {
            // 去掉`查看`按钮
            $tools->disableView();

        });


        // 更新留言數
        $form->saved(function (Form $form) {
            
            $video_id = $form->model()->id;;
        
            if($video = Topic::find($video_id)){
                $video_replies_count = Reply::where('topic_id',$video_id)->count();
                $video->reply_count=$video_replies_count;
                $video->save();
    
            }

        });


        return $form;
    }
}

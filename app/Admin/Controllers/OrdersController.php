<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class OrdersController extends AdminController
{
    protected $title = '訂單';

    protected function grid()
    {
        $grid = new Grid(new Order());

        // 只展示已支付的訂單，並且預設按支付時間倒序排序
        $grid->model()->whereNotNull('paid_at')->orderBy('paid_at', 'desc');

        $grid->no('訂單流水號');
        // 展示關聯關係的欄位時，使用 column 方法
        $grid->column('user.name', '買家');
        $grid->total_amount('總金額')->sortable();
        $grid->paid_at('支付時間')->sortable();
        $grid->ship_status('物流')->display(function($value) {
            return Order::$shipStatusMap[$value];
        });
        $grid->refund_status('退款狀態')->display(function($value) {
            return Order::$refundStatusMap[$value];
        });
        // 禁用建立按鈕，後臺不需要建立訂單
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            // 禁用刪除和編輯按鈕
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->tools(function ($tools) {
            // 禁用批量刪除按鈕
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('檢視訂單')
            // body 方法可以接受 Laravel 的 view
            ->body(view('admin.orders.show', ['order' => Order::find($id)]));
    }


    protected function form()
    {
        $form = new Form(new Order());

        $form->text('no', __('No'));
        $form->number('user_id', __('User id'));
        $form->textarea('address', __('Address'));
        $form->decimal('total_amount', __('Total amount'));
        $form->textarea('remark', __('Remark'));
        $form->datetime('paid_at', __('Paid at'))->default(date('Y-m-d H:i:s'));
        $form->text('payment_method', __('Payment method'));
        $form->text('payment_no', __('Payment no'));
        $form->text('refund_status', __('Refund status'))->default('pending');
        $form->text('refund_no', __('Refund no'));
        $form->switch('closed', __('Closed'));
        $form->switch('reviewed', __('Reviewed'));
        $form->text('ship_status', __('Ship status'))->default('pending');
        $form->textarea('ship_data', __('Ship data'));
        $form->textarea('extra', __('Extra'));

        return $form;
    }
}

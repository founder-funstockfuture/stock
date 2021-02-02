<?php

namespace App\Services;

//use App\Models\Order;

//引入綠界SDK
require (app_path() . '/Handlers/ecpay/ECPay.Payment.Integration.php');

class EcpayPaymentService
{
	//付款
    public function fund($order)
    {
        $obj = new \ECPay_AllInOne();

        //服務參數
        $obj->ServiceURL  = config('app.ecpay_api_url');
        $obj->HashKey     = config('app.ecpay_hashkey');
        $obj->HashIV      = config('app.ecpay_hashiv');
        $obj->MerchantID  = config('app.ecpay_merchantid');
        //CheckMacValue加密類型，請固定填入1，使用SHA256加密
        $obj->EncryptType = '1';

		//訂單編號(限制20碼，使用19碼)
        $obj->Send['MerchantTradeNo']   = $order->no.mt_rand(100,999);
		//交易時間
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');
		//交易金額
        $obj->Send['TotalAmount']       = $order->total_amount;
		//交易描述
        $obj->Send['TradeDesc']         = "支付商品訂單";
		//付款方式:全功能
        $obj->Send['ChoosePayment']     = \ECPay_PaymentMethod::ALL;
        // 允許繳費有效天數
        $obj->Send['ExpireDate']     = 7;

        // 迴圈遍歷訂單的商品
        $order->load('items.product');
        foreach ($order->items as $item) {
            // 計算對應商品的銷量
            array_push($obj->Send['Items'],
                array('Name' => $item->product->title, 
                        'Price' => $item->price,
                        'Currency' => "元", 
                        'Quantity' => $item->amount, 
                        'URL' => "dedwed"));
        }
		

       // ----電子發票參數----
       $obj->Send['InvoiceMark'] = \ECPay_InvoiceState::Yes;
       // 自訂不重覆編號
       $obj->SendExtend['RelateNumber'] = "I".$order->no.mt_rand(100,999);
       // 客戶 ID
       $obj->SendExtend['CustomerID'] = '' ;

       // 是否需列印(若有統編一定是1)
       $obj->SendExtend['Print'] = '0' ;
       // 捐贈為1
       $obj->SendExtend['Donation'] = '0';
       // 捐贈碼
       $obj->SendExtend['LoveCode'] = '' ;

       // 統一編號
       $obj->SendExtend['CustomerIdentifier'] = '' ;
       // 需列印時要有值
       $obj->SendExtend['CustomerName'] = $order->user->name;
       $obj->SendExtend['CustomerAddr'] = '';

       // 需列印時，其一要有值
       $obj->SendExtend['CustomerEmail'] = $order->user->email;
       $obj->SendExtend['CustomerPhone'] = $order->user->mobile??'';

       //應稅為1
       $obj->SendExtend['TaxType'] = \ECPay_TaxType::Dutiable;

       $obj->SendExtend['InvoiceItems'] = array();
       // 將商品加入電子發票商品列表陣列
       foreach ($obj->Send['Items'] as $info)
       {
           array_push($obj->SendExtend['InvoiceItems'],array(
               'Name' => $info['Name'],
               'Count' =>$info['Quantity'],
               'Word' => '個',
               'Price' => $info['Price'],
               'TaxType' => \ECPay_TaxType::Dutiable));
       }

       // 1 是綠界載具 2 自然人憑證 3 手機載具
       $obj->SendExtend['CarruerType'] = '1';


       $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
       $obj->SendExtend['DelayDay'] = '0';
       // 一般稅額是 07
       $obj->SendExtend['InvType'] = \ECPay_InvType::General;


        //產生訂單(auto submit至ECPay)
        $obj->CheckOut();

    }
	

}

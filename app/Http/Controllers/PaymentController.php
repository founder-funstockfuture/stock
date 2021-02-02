<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Exceptions\InvalidRequestException;
use App\Events\OrderPaid;
use App\Services\EcpayPaymentService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{

    //綠界支付
    public function payByEcpay(Order $order, EcpayPaymentService $ecpayPaymentService,Request $request)
    {
        // 判斷訂單是否屬於當前使用者
        $this->authorize('own', $order);

        // 訂單已支付或者已關閉
        if ($order->paid_at || $order->closed) {
            throw new InvalidRequestException('訂單狀態不正確');
        }

        // 呼叫綠界的網頁支付
        return $ecpayPaymentService->fund($order);
    }

    /*
    //回傳的綠界科技的付款結果訊息如下:
    Array
    (
        [CustomField1] => 
        [CustomField2] => 
        [CustomField3] => 
        [CustomField4] => 
        [MerchantID] => 2000132
        [MerchantTradeNo] => 19101816581130968
        [PaymentDate] => 2019/10/18 16:58:41
        [PaymentType] => Credit_CreditCard
        [PaymentTypeChargeFee] => 1
        [RtnCode] => 1
        [RtnMsg] => 交易成功
        [SimulatePaid] => 0
        [StoreID] => 
        [TradeAmt] => 23
        [TradeDate] => 2019/10/18 16:58:11
        [TradeNo] => 1910181658118023
    )
   */

    // 金流伺服器端回撥接收
    public function ecpayNotify(Request $request)
    {
        //引入綠界SDK
        require (app_path() . '/Handlers/ecpay/ECPay.Payment.Integration.php');
        // 校驗輸入參數post
        $data = $request->input();
        foreach ($data as $keys => $value) {
            if ($keys != 'CheckMacValue') {
                //過濾標籤
                $arFeedback[$keys] = strip_tags($value);
            }
        }
		
        // 計算出 CheckMacValue($data含CheckMacValue)
        $CheckMacValue = \ECPay_CheckMacValue::generate( $data, 
        config('app.ecpay_hashkey'), config('app.ecpay_hashiv'), '1');

        // ATM 取號
        if($_POST['RtnCode'] =='2' && $CheckMacValue == $_POST['CheckMacValue'])
        {
            return '1|OK';
        }

        // CVS/BARCODE 取號
        if($_POST['RtnCode'] =='10100073' && $CheckMacValue == $_POST['CheckMacValue'])
        {
            return '1|OK';
        }

        // 必須要支付成功並且驗證碼正確
        if($_POST['RtnCode'] =='1' && $CheckMacValue == $_POST['CheckMacValue'])
        {
            // $data->out_trade_no 拿到訂單流水號，並在資料庫中查詢
            $order = Order::whereRaw('no = ? and total_amount = ?', 
            [substr($arFeedback['MerchantTradeNo'],0,-3),$arFeedback['TradeAmt']])->first();
			$user = User::where('id',$order->user_id)->firstOrFail();
            // 正常來說不太可能出現支付了一筆不存在的訂單，這個判斷只是加強系統健壯性。
            if (!$order) {
                return 'fail';
            }

            // 如果這筆訂單的狀態已經是已支付，返回資料給綠界
            if ($order->paid_at) {
                return '1|OK';
            }
			
            \DB::transaction(function () use ($order, $data, $user) {
                // 更新訂單狀態
                $order->update([
                    'paid_at'        => Carbon::now(), // 支付時間
                    //'payment_method' => 'ecpay', // 支付方式
                    'payment_no'     => $data['TradeNo'], // 綠界訂單號
                ]);


            });

            $this->afterPaid($order);
        }

        return '1|OK';
    }

    protected function afterPaid(Order $order)
    {
        //觸發更新銷量、寄送通知
        event(new OrderPaid($order));
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VerificationMobileRequest;
use App\Http\Requests\VerificationCodeRequest;
//use App\Exceptions\InvalidRequestException;
use Illuminate\Support\Str;
use Exception;
use Cache;
use Auth;
use Illuminate\Auth\AuthenticationException;
use Carbon\Carbon;
use GuzzleHttp\Client;

class VerificationCodesController extends Controller
{
    use \App\Models\Traits\CmoneyHelper;


    // 1.接收輸入的手機號碼。要存在 Cache 中。
    public function storeMobile(VerificationMobileRequest $request)
    {
        $mobile = $request->mobile;

        // 檢查是否已使用 >=3 次
        if(!$this->checkMobilePasswordResetMoreThenTimes()){
            return redirect()->route('password.request')
            ->with('warning', '簡訊傳送忘記密碼已超過3次，請改用 Email 驗證!');
        }

        if (!app()->environment('production')) {
            $code = '12345';

        } else {
            // 生成五碼數字
            $code = str_pad(random_int(1, 99999), 5, 0, STR_PAD_LEFT);

            try {
                // 送出簡訊
                $this->sendSMS($code,$mobile);

            } catch (Exception $e) {
                throw new Exception('簡訊傳送異常!');

            }
        }


        $key = 'verificationCode_'.Str::random(15);
        $expiredAt = now()->addMinutes(5);

        // 驗證碼 5 分鐘後過期
        Cache::put($key, ['mobile' => $mobile, 'code' => $code], $expiredAt);

        return response()->json([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }


    // 2.比對接收的驗證碼。成功後更新已驗證並直接登入，轉向到忘記密碼頁面。
    public function storeCode(VerificationCodeRequest $request)
    {
        $verifyData = Cache::get($request->verification_key);

        if (!$verifyData) {
           abort(403, '驗證碼已失效');
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            throw new AuthenticationException('驗證碼錯誤');
        }

        $request->user()->update([
            'mobile' => $verifyData['phone'],
            'mobile_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        // 清除驗證碼快取
        Cache::forget($request->verification_key);

        // 自動登入
        $attributes=['email'=>$request->user()->email,'password'=>$request->user()->password];
        if (Auth::attempt($attributes)) {
            // 導向更改密碼的頁面
            return redirect()->route('password.reset')->with('success', '請重新設定密碼！');

        }else{
            throw new AuthenticationException('自動登入錯誤!');
        }

    }


    // 檢查簡訊傳送次數
    private function checkMobilePasswordResetMoreThenTimes(){
        $reset_times=Auth::user()->mobile_password_reset_times;
        if($reset_times>=3){
            return false;
        }
        return true;
    }



    //三竹簡訊
    private function sendSMS($code,$mobile)
    {
        $http = new Client;

        $mobile='0928091636';
        $token='1234566pp';
        
        $smbody="FUN股網 驗證碼：".$code."，請輸入驗證碼，進行手機號碼認證";
        $url = 'https://smsapi.mitake.com.tw/api/mtk/SmSend?';

        // 構建請求參數
        $query = http_build_query([
            "CharsetURL"     =>  'UTF-8',
            "username"  => env('MITAKE_USERNAME'),
            "password"    => env('MITAKE_PASSWORD'),
            "dstaddr" => $mobile,
            "smbody" => $smbody
        ]);

        // 傳送 HTTP Get 請求
        $response = $http->get($url.$query);

        $result = json_decode($response->getBody(), true);

        /* Response 
        [1] 
        msgid=#000000013 
        statuscode=1 
        AccountPoint=126 
        */
        $result2 = str_replace("\r\n",'',$result);
        if (preg_match('/^(.+)statuscode\=(\d)(.+)$/', $result2, $m)) {
            // 1,2送出簡訊，4已送達
            if (in_array($m[2], ['1', '2', '4'])) {
                // 送出成功
                // mobile_password_reset_times + 1
                Auth::user()->increment('mobile_password_reset_times', 1);
            }
        }

    }



}

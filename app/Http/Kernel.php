<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // 全局中間件
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        // 修正代理服務器後的服務器參數
        \App\Http\Middleware\TrustProxies::class,
        // 解決 cors 跨域問題
        \Fruitcake\Cors\HandleCors::class,
        // 檢測應用是否進入『維護模式』
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // 檢測表單請求的數據是否過大
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // 對所有提交的請求數據進行 PHP 函數 `trim()` 處理
        \App\Http\Middleware\TrimStrings::class,
        // 將提交請求參數中空子串轉換爲 null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    // 設定中間件組
    protected $middlewareGroups = [
        // Web 中間件組，應用於 routes/web.php 路由文件，
        // 在 RouteServiceProvider 中設定
        'web' => [
            // Cookie 加密解密
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            // 將系統的錯誤數據注入到視圖變量 $errors 中
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            // 處理路由綁定
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            // 驗證 email 是否註冊
            \App\Http\Middleware\EnsureEmailIsVerified::class,
            // 記錄用戶最後活躍時間
            \App\Http\Middleware\RecordLastActivedTime::class,
			// 檢查使用者是否被停權
			\App\Http\Middleware\CheckUserBanned::class,
        ],
        // API 中間件組，應用於 routes/api.php 路由文件，
        // 在 RouteServiceProvider 中設定
        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    // 中間件別名設置，允許你使用別名調用中間件，例如上面的 api 中間件組調用
    protected $routeMiddleware = [
        // 只有登錄用戶才能訪問
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        // 用戶授權功能
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        // 只有遊客才能訪問
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // 密碼確認，你可以在做一些安全級別較高的修改時使用，例如說支付前進行密碼確認
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        // 簽名認證，在找回密碼章節裏我們講過
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        // Laravel 自帶的強制用戶郵箱認證的中間件
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        // 限定 public ip
        'restrictIp' => \App\Http\Middleware\IpMiddleware::class,
        
    ];
}

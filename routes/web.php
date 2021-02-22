<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@root')->name('root');

Auth::routes(['verify' => true]);

/*
// 用戶身份驗證相關的路由
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 用戶註冊相關路由
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 密碼重置相關路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email 認證相關路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

*/


// 使用者頁面
Route::get('users/{user}', 'UsersController@show')->name('users.show');


//第三方登入
Route::get('login/{socialite_name}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{socialite_name}/callback', 'Auth\LoginController@handleProviderCallback');


//Route::redirect('/', '/products')->name('root');
Route::get('products', 'ProductsController@index')->name('products.index');


// 文章頁面
Route::get('topics', 'TopicsController@index')->name('topics.index');

Route::resource('topic_categories', 'TopicCategoriesController', ['only' => ['show']]);
//Route::get('/categories/{topic_category}', 'CategoriesController@show')->name('categories.show');

Route::group(['middleware' => ['auth']], function() {

    // 須驗證過信箱
    Route::group(['middleware' => ['verified']], function() {
        Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');
        Route::put('users/{user}', 'UsersController@update')->name('users.update');
        
        Route::get('topics/create', 'TopicsController@create')->name('topics.create');
        Route::post('topics', 'TopicsController@store')->name('topics.store');
        Route::get('topics/{topic}/edit', 'TopicsController@edit')->name('topics.edit');
        Route::put('topics/{topic}', 'TopicsController@update')->name('topics.update');
        Route::delete('topics/{topic}', 'TopicsController@destroy')->name('topics.destroy');

        //Route::resource('topics', 'TopicsController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);
        // 上傳文章圖片
        Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');
        // 文章回復
        Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);
        // 留言回復
        Route::resource('replies2', 'Replies2Controller', ['only' => ['store', 'destroy']]);
        // 文章收藏
        Route::post('topics/{topic}/favorite', 'TopicsController@favor')->name('topics.favor');
        Route::delete('topics/{topic}/favorite', 'TopicsController@disfavor')->name('topics.disfavor');
        // 關注文章
        Route::post('topics/{topic}/subscriptions', 'TopicsController@subscribe')->name('topics.subscribe');
        Route::delete('topics/{topic}/subscriptions', 'TopicsController@unsubscribe')->name('topics.unsubscribe');


        // 商品收藏
        Route::post('products/{product}/favorite', 'ProductsController@favor')->name('products.favor');
        Route::delete('products/{product}/favorite', 'ProductsController@disfavor')->name('products.disfavor');
        // 商品收藏頁
        Route::get('products/favorites', 'ProductsController@favorites')->name('products.favorites');
        Route::post('cart', 'CartController@add')->name('cart.add');
        Route::get('cart', 'CartController@index')->name('cart.index');
        Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');

        // 新增訂單
        Route::post('orders', 'OrdersController@store')->name('orders.store');
        // 訂單頁面
        Route::get('orders', 'OrdersController@index')->name('orders.index');
        Route::get('orders/{order}', 'OrdersController@show')->name('orders.show');
        // 訂單評價
        Route::get('orders/{order}/review', 'OrdersController@review')->name('orders.review.show');
        Route::post('orders/{order}/review', 'OrdersController@sendReview')->name('orders.review.store');


        // 下單前確認頁
        //Route::post('checkout', 'CheckoutController@index')->name('checkout.index');
        
        // 金流
        Route::get('payment/{order}/ecpay', 'PaymentController@payByEcpay')->name('payment.ecpay');

        // 簡訊
        Route::get('verification_codes/create', 'VerificationCodesController@create')->name('verificationCodes.create');
        Route::post('verification_mobile', 'VerificationCodesController@storeMobile')->name('verificationCodes.storeMobile');
        Route::post('verification_code', 'VerificationCodesController@storeCode')->name('verificationCodes.storeCode');


        // 使用者標籤
        Route::resource('tags', 'TagsController');
        Route::get('tags/user_tags', 'TagsController@userTags')->name('tags.user_tags');

        
        Route::post('/topics/{topic}/subscriptions', 'SubscribeTopicsController@store')->name('subscribe-topics.store');
        Route::delete('/topics/{topic}/subscriptions', 'SubscribeTopicsController@destroy')->name('subscribe-topics.destroy');




        
    });
});

// 文章頁面
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');

// 產品詳細頁
Route::get('products/{product}', 'ProductsController@show')->name('products.show');

// 消息通知
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);


//金流回傳接收
Route::post('payment/ecpay/notify', 'PaymentController@ecpayNotify')->name('payment.ecpay.notify');






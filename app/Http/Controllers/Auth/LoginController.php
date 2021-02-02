<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Socialite;
use App\models\User;
//use Carbon\Carbon;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    // 加入手機號碼驗證
    protected function credentials(Request $request)
    {
        if(is_numeric($request->input('email'))){
            return ['mobile'=>$request->input('email'),'password'=>$request->input('password')];
        }
        
        return ['email' => $request->input('email'), 'password'=>$request->input('password')];
    }



    /**
     * Redirect the user to the third party authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($socialite_name)
    {
        return Socialite::driver($socialite_name)->redirect();
    }

    /**
     * Obtain the user information from third party.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($socialite_name)
    {
        $user = Socialite::driver($socialite_name)->user();
		
		/*
			取得 facebook 資料
		^ Laravel\Socialite\Two\User {#671 ▼
			  +token: "EAAk5RSWjEkQBABZBeTZBFMkrbBD3YQ3KZA65WAtxCLY1Vw52rmQa45X2bZBZCiJSomP34O4hNdTcZCc9RRZCS6XLvLDTMNwqsehqn32zdr5VzXzZBuWEPdRXPuFH1z6S8YXeHkrWNIxV9ZBlhjDFviM8szpVTgT ▶"
			  +refreshToken: null
			  +expiresIn: 5183590
			  +id: "177097453712918"
			  +nickname: null
			  +name: "Sun Jim"
			  +email: "jim@ezdivemag.com"
			  +avatar: "https://graph.facebook.com/v3.0/177097453712918/picture?type=normal"
			  +user: array:3 [▶]
			  +"avatar_original": "https://graph.facebook.com/v3.0/177097453712918/picture?width=1920"
			  +"profileUrl": null
			}
		*/
		
        // OAuth2 Providers
        //$token = $user->token;

        //$refreshToken = $user->refreshToken; // not always provided
        //$expiresIn = $user->expiresIn;
		
        // OAuth1 Providers
        //$token = $user->token;
        //$tokenSecret = $user->tokenSecret;
		
		if(is_null($user->getEmail()))
		{
			//throw new Exception('未授權取得使用者 Email');
			if($socialite_name=='facebook'){
				return redirect('login')->with('warning', 'Facebook 未取得使用者 Email，請確認信箱已在 Facebook 註冊並驗證!');
			}
		}

        if($socialite_name!='google' && $socialite_name!='facebook'){
            return redirect('login')->with('danger', '無法使用此認證方式!');
        }

		if($finduser = User::where('provider_id', $user->getId())->first()){
			Auth::login($finduser);
 
		}else{
			if($finduser = User::where('email', $user->email)->first()){
				$finduser->provider_id = $user->getId();
				$finduser->save();
				
				Auth::login($finduser);
			}else{
				$newUser = User::create([
					'name' => $user->name,
					'email' => $user->email,
					'provider_id' => $user->getId()??'',
					'avatar' => $user->getAvatar()??'',
					'email_verified_at' => now(),
					'password' => encrypt('123456dummy')
				]);
				
				Auth::login($newUser);
			}
			
		}

        return redirect()->route('root')->with('success', $socialite_name.' 登入成功！');

    }
    




}

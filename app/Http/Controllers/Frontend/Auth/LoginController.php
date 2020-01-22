<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\Employer;
use App\Model\GeneralSetting;
use App\Model\SocialLogin;
use App\Model\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Config;
use Socialite;
use Hash;
class LoginController extends Controller
{

use SendSms,SendEmail;

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $temp_guard = 'web';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
    public function username()
    {
        return 'username';
    }
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }
    protected function guard(){
        return Auth::guard($this->temp_guard);
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'login_type' => 'required|string',
        ]);
    }
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if($request->login_type === 'candidate'){
            $this->temp_guard = 'web';
        }elseif($request->login_type === 'employer'){
            $this->temp_guard = 'employer';
        }

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return redirect()->intended(route($this->getRoute($request->login_type)));
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function setConfig($provider,$redirect_url){
        $gnl = GeneralSetting::first();
        $prov = [
            'facebook' =>[
                'client_id' => $gnl->fb_client_id,
                'client_secret' => $gnl->fb_client_secret,
                'redirect' => $redirect_url,
            ],
            'google'=> [
                'client_id' => $gnl->google_client_id,
                'client_secret' => $gnl->google_client_secret,
                'redirect' => $redirect_url,
            ]
        ];
        return $prov[$provider];
    }
    public function getInstance($user_type){
        if($user_type === 'candidate'){
            $instance  =  app(User::class);
        }elseif($user_type === 'employer'){
            $instance  = app(Employer::class);
        }
        return $instance;
    }
    public function getRoute($user_type){

        if($user_type === 'candidate'){
            $route = 'user.profile';
            // $route = 'user.profile';
        }
        if($user_type === 'employer'){
            // $route = 'employer.dashboard';
            $route = 'employer.profile';
        }
        return $route;
    }
    public function redirectToProvider($user_type,$provider)
    {
        $except_arr = [];
        if(general_setting()->fb_login){
            $except_arr[] =  'facebook';
        }
        if(general_setting()->google_login){
            $except_arr[] =  'google';
        }
       if(!in_array($user_type,['candidate','employer']) || !in_array($provider,$except_arr))
           return back()->with('error','Something Wrong');
        Config::set('services.'.$provider,$this->setConfig($provider,route('social.login_callback',[$user_type,$provider])));
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($user_type,$provider)
    {
        $except_arr = [];
        if(general_setting()->fb_login){
            $except_arr[] =  'facebook';
        }
        if(general_setting()->google_login){
            $except_arr[] =  'google';
        }

        if(!in_array($user_type,['candidate','employer']) || !in_array($provider,$except_arr))
            return back()->with('error','Something Wrong');

        $cog =    $this->setConfig($provider,route('social.login_callback',[$user_type,$provider]));
        Config::set('services.'.$provider,$cog);
        $social_user = Socialite::driver($provider)->user();
        $social_login = SocialLogin::where('model_type',get_class($this->getInstance($user_type)))->where('provider',$provider)->where('provider_id', $social_user->id)->first();
        if (!$social_login){

            $user = null;
            if(isset($social_user->email))
                $user = $this->getInstance($user_type)->where('email',$social_user->email)->first();
            if(!$user){
                $user = new $this->getInstance($user_type);
                $user->username  = isset($social_user->email)? explode('@',$social_user->email)[0].'_'.$social_user->id :$social_user->id;
                $user->email =isset($social_user->email)? $social_user->email:$social_user->id . '@' . $provider;
                $user->phone = null;
                $user->password = Hash::make($provider);
                $user->email_verified = 1;
                $user->sms_verified = 1;
                $user->status = 1;
                $user->save();
            }
            $social_login = new SocialLogin();
            $social_login->model_type =get_class($this->getInstance($user_type));
            $social_login->model_id =$user->id;
            $social_login->provider =$provider;
            $social_login->provider_id = $social_user->id;
            $social_login->save();
        }
        Auth::guard($user_type==='candidate'?'web':'employer')->login($social_login->user);
        return redirect()->intended(route($this->getRoute($user_type)));
    }
}

<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\Employer;
use App\Mail\Verification; //elis
use Illuminate\Support\Facades\Mail; //elis
use App\Model\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
//use Mail; // elis
use Validator;
class RegisterController extends Controller
{



    use RegistersUsers,SendEmail,SendSms;
    protected $temp_guard = 'web';
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }


    public function register(Request $request)
    {

        $gs = general_setting();
        if(!$gs->reg){
            return back()->with('error','Currently registration off');
        }

        // $route = 'user.dashboard';
        $route = 'user.profile';
        if($request->register_type === 'candidate'){
            $this->temp_guard = 'web';
            $user =new User();
            $table ='users';
        }
        if($request->register_type === 'employer'){
            $this->temp_guard = 'employer';
            // $route = 'employer.dashboard';
            $route = 'employer.dashboard';
            $user =new Employer();
            $table ='employers';
        }
        $this->validate($request,[
            'username' => ['required', 'string', 'max:255','unique:'.$table],
            'email' => ['required', 'string', 'email', 'max:255','unique:'.$table],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->email_verified = $gs->ev?0:1;
        $user->sms_verified = $gs->mv?0:1;
        $user->email_verified_code = $gs->ev? rand(1000, 9999):NULL;
        $user->sms_verified_code = $gs->mv?rand(1000, 9999):NULL;
        if ($gs->ev) {
            $code = $user->email_verified_code;
            $to = $user->email;
            $name = $user->username;
            $subjectVerif = "Verification Code";
            $messageVerif = "Your verification code is: " . $code;
            // $this->sendEmail( $to, $name, $subject, $message);
            //  dd($to);
            $data = collect(['Hello: '=>$name,'subject'=>$subjectVerif,'infomation'=>$messageVerif]);
            // dd(gettype($data));
                Mail::to($to)->send(  //eli
                    new Verification($data)
            );
            $user->vsent = time();
            $user->email_send = 1;
        } else {
            $user->email_send = 0;
        }
        if ($gs->mv) {
            $code = $user->sms_verified_code;
            $to = $user->phone;
            $message = "Your verification code is: " . $code;
            $this->sendSms( $to, $message);
            $user->vsent = time();
            $user->sms_send = 1;
        } else {
            $user->sms_send = 0;
        }
        $user->save();
        if (Auth::guard($this->temp_guard)->attempt([ 'username' => $request->username,'password' => $request->password])) {
            return redirect()->intended(route($route));
        }
return redirect()->route('home');
    }


}

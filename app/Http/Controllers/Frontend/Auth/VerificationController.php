<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\User;
//use App\Mail\ProjectCreatedOne; //eli
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class VerificationController extends Controller
{
    use SendEmail,SendSms;
    public function __construct()
    {

    }

    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */
  protected $except_guard = ['web','employer'];
  public function getGuard(){
      $guard = null;
      foreach ($this->except_guard as $v){
          if(auth()->guard($v)->check()){
              $guard =    $v;
          }
      }
      return $guard;
  }
  public function getHomeRoute(){
      if($this->getGuard() === 'web'){
          return 'user.dashboard';
      }
      if($this->getGuard() === 'employer'){
          return 'employer.dashboard';
      }
  }
    public function showEmailVerForm() {
        if(Auth::guard($this->getGuard())->check() && !Auth::guard($this->getGuard())->user()->email_verified) {

            if (!Auth::guard($this->getGuard())->user()->email_sent) {
                $to = Auth::guard($this->getGuard())->user()->email;
                $name = Auth::guard($this->getGuard())->user()->name;
                $subject = "Email verification code";
                $message = "Your verification code is: " . Auth::guard($this->getGuard())->user()->email_verified_code;
                $this->sendEmail( $to, $name, $subject, $message);

            //     \Mail::to(auth()->user()->email)->send(  //eli
            //         new ProjectCreatedOne($to,$name,$subject,$message)
            //   );

                $emp = Auth::guard($this->getGuard())->user();
                $emp->email_send = 1;
                $emp->save();
            }

            return view('frontend.auth.email_verification');
        }

        return redirect()->route($this->getHomeRoute());

    }

    public function showSmsVerForm() {
        if(Auth::guard($this->getGuard())->check() && Auth::guard($this->getGuard())->user()->sms_verified == 0) {

            if (Auth::guard($this->getGuard())->user()->sms_send == 0) {
                $to = Auth::guard($this->getGuard())->user()->phone;
                $message = "Your verification code is: " . Auth::guard($this->getGuard())->user()->sms_verified_code;
                $this->sendSms( $to, $message);


                $emp = Auth::guard($this->getGuard())->user();
                $emp->sms_send = 1;
                $emp->save();
            }
            return view('frontend.auth.sms_verification');

        }
        return redirect()->route($this->getHomeRoute());
    }

    public function emailVerification(Request $request) {

        $messages = [
            'email_verified_code.required' => 'Email verification code is required',
        ];
        $validatedData = $request->validate([
            'email_verified_code' => 'required',
        ],$messages);
        $emp = Auth::guard($this->getGuard())->user();
        if($emp->email_verified_code == $request->email_verified_code) {
            $emp->email_send = 0;
            $emp->email_verified = 1;
            $emp->save();
            $emp->vsent = 0;
            return redirect()->intended(route($this->getHomeRoute()));
        }
        throw ValidationException::withMessages(['email_verified_code'=>'Verification code didn\'t match!']);
    }

    public function smsVerification(Request $request) {
        $messages = [
            'sms_verified_code.required' => 'SMS verification code is required',
        ];
        $validatedData = $request->validate([
            'sms_verified_code' => 'required',
        ],$messages);
        $emp =  Auth::guard($this->getGuard())->user();
        if($emp->sms_verified_code == $request->sms_verified_code) {
            $emp->sms_send = 0;
            $emp->sms_verified = 1;
            $emp->save();
            return redirect()->intended(route($this->getHomeRoute()));
        }
        throw ValidationException::withMessages(['sms_verified_code'=>'Verification code didn\'t match!']);
    }

    public function sendVcode(Request $request)
    {

        $emp = Auth::guard($this->getGuard())->user();
        $chktm = $emp->vsent+1000;

        if ($chktm > time()){
            $delay = $chktm-time();
            throw ValidationException::withMessages(['resend'=>'Please Try after '.$delay.' Seconds']);
        }else{
            $code = rand(1000, 9999);
            $msg = 'Your Verification code is: '.$code;
            if($request->email){
                $emp->email_verified_code = $code ;
                $emp->email_send = 1 ;
                $emp->vsent = time();
                $emp->save();
                $this->sendEmail($emp->email, $emp->username, 'Verification Code', $msg);
                return back()->with('success', 'Email verification code sent successfully');
            }elseif($request->phone){
                $emp->sms_verified_code = $code ;
                $emp->sms_send = 1 ;
                $emp->vsent = time();
                $emp->save();
                $this->sendSms($emp->mobile, $msg);
                return back()->with('success', 'SMS verification code sent successfully');
            }else{
                throw ValidationException::withMessages(['resend'=>'Sending Failed']);
            }

        }

    }
}

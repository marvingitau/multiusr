<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\Employer;
use App\Model\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use DB;
class ForgotPasswordController extends Controller
{
use SendEmail,SendSms;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm()
    {
        return view('frontend.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'user_type'=>'required'
        ]);
        if($request->user_type === 'candidate'){
            $user = User::where('email', $request->email)->first();
        }elseif ($request->user_type === 'employee'){
            $user = Employer::where('email', $request->email)->first();
        }
        if ($user == null)
        {
            return back()->with('error', 'Email Not Available');
        }
        else
        {
            $to =$user->email;
            $name = $user->first_name;
            $subject = 'Password Reset';
            $code = str_random(30);
            $message = 'Use This Link to Reset Password: <a href="'.route('user.password.reset',[$code,$request->user_type]).'">'.route('user.password.reset',[$code,$request->user_type]).'</a>';

            DB::table('password_resets')->insert(
                ['email' => $to, 'token' => $code, 'status' => 0, 'created_at' => date("Y-m-d h:i:s")]
            );
            $this->sendEmail( $to, $name, $subject, $message);

            return back()->with('success', 'Password Reset Email Sent Successfully');
        }
    }

    public function resetLink($code,$user_type)
    {

        if(!$reset = DB::table('password_resets')->where('token', $code)->orderBy('created_at', 'desc')->first()){
            return redirect()->route('auth.login')->with('error', 'Invalid Reset Link');
        }
        if ( $reset->status == 1)
        {
            return redirect()->route('auth.login')->with('error', 'Invalid Reset Link');
        }else{
            return view('frontend.auth.passwords.reset', compact('reset','user_type'));
        }

    }

    public function passwordReset(Request $request,$user_type)
    {

        $this->validate($request,[
            'email' => 'required',
            'token' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $reset = DB::table('password_resets')->where('token', $request->token)->orderBy('created_at', 'desc')->first();
        if($user_type === 'candidate'){
            $user = User::where('email', $reset->email)->first();
        }elseif ($user_type === 'employee'){
            $user = Employer::where('email', $reset->email)->first();
        }else{
            return redirect()->route('auth.login')->with('error', 'Invalid Reset Link');
        }
        if ( $reset->status == 1)
        {
            return redirect()->route('auth.login')->with('error', 'Invalid Reset Link');
        }
        else
        {
            if($request->password == $request->password_confirmation)
            {
                $user->password = bcrypt($request->password);
                $user->save();

                DB::table('password_resets')->where('email', $user->email)->update(['status' => 1]);

                $msg =  'Password Changed Successfully';
                $this->sendEmail( $user->email, $user->username, 'Password Changed', $msg);
                $sms =  'Password Changed Successfully';
                $this->sendSms($user->mobile, $sms);

                return redirect()->route('auth.login')->with('success', 'Password Changed');
            }
            else
            {
                return back()->with('error', 'Password Not Matched');
            }
        }
    }
}

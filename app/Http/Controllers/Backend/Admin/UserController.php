<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Helper\MimeCheckRules;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use DB;
use App\Mail\KMRC_Message; //eli
class UserController extends Controller
{
    use SendEmail,SendSms;
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user){

        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user;
        if(\request()->search){
            $users=$users->where('username', 'like', '%' . request()->search . '%')
                ->orWhere('email', 'like', '%' . request()->search . '%')
                ->orWhere('first_name', 'like', '%' . request()->search . '%')
                ->orWhere('last_name', 'like', '%' . request()->search . '%');
                
            $usersDeactivated=$users->withTrashed()->where('username', 'like', '%' . request()->search . '%')
                ->orWhere('email', 'like', '%' . request()->search . '%')
                ->orWhere('first_name', 'like', '%' . request()->search . '%')
                ->orWhere('last_name', 'like', '%' . request()->search . '%');
        }
        $users=$users->orderBy('id', 'desc')->paginate(20);
        $usersDeactivated= User::onlyTrashed()->orderBy('id', 'desc')->paginate(20);
        
        // dd($usersDeactivated);
        return view('backend.admin.users.index', compact('users','usersDeactivated'));
    }

    public function view($id)
    {
        $user = $this->user->findOrFail($id);
        return view('backend.admin.users.view', compact('user'));
    }
    
     public function activate($id)
    {
        $user =User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return back();
    }
     public function deactivate($id)
    {
        
        $user = $this->user->findOrFail($id);
        $user->delete();
        return back();
    }
    
     public function forceDelete($id)
    {
        
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return back();
    }

    public function email($id)
    {
        $user = User::findOrFail($id);
        return view('backend.admin.users.email',compact('user'));
    }

    public function emailSendToUser(Request $request)
    {
        $this->validate($request,
            [
                'emailto' => 'required|email',
                'reciver' => 'required',
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);
        $to = $request->emailto;
        $name = $request->reciver;
        $subject = $request->subject;
        $message = $request->emailMessage;
        // $this->sendEmail($to, $name, $subject, $message);
        \Mail::to($to)->send(  //eli
            new KMRC_Message($name,$subject,$message)
      );
        return back()->withSuccess('Mail Sent Successfully');

    }

    public function broadcast()
    {
        return view('backend.admin.users.broadcast');
    }

    public function broadcastEmail(Request $request)
    {
        $this->validate($request,
            [
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);

        $users = User::where('status', '1')->get();

        foreach ($users as $user)
        {

            $to = $user->email;
            $name = $user->username;
            $subject = $request->subject;
            $message = $request->emailMessage;

            
        \Mail::to($to)->send(  //eli
            new KMRC_Message($name,$subject,$message)
      );

            // $this->sendEmail($to, $name, $subject, $message);
        }

        return back()->withSuccess('Mail Sent Successfully');
    }

    public function userPasschange(Request $request,$id)
    {
        $user = User::find($id);

        $this->validate($request,
            [
                'password' => 'required|string|confirmed'
            ]);
        if($request->password == $request->password_confirmation)
        {
            $user->password = bcrypt($request->password);
            $user->save();

            $msg =  'Password Changed By Admin. New Password is: '.$request->password;
            $this->sendEmail($user->email, $user->username, 'Password Changed', $msg);
            $sms =  'Password Changed By Admin. New Password is: '.$request->password;
            $this->sendSms($user->mobile, $sms);

            return back()->with('success', 'Password Changed');
        }
        else
        {
            return back()->with('alert', 'Password Not Matched');
        }
    }

    public function detailsUpdate(Request $request,$id)
    {
        $user = User::find($id);

        $this->validate($request,
            [
                'phone' => 'required|string|max:255',
                'email' => 'required|email|string|max:255',
                'user_image'=>['image',new MimeCheckRules(['jpg','png','jpeg'])]
            ]);

        $user['first_name'] = $request->first_name ;
        $user['last_name'] = $request->last_name;
        $user['phone'] = $request->phone;
        $user['email'] = $request->email;
        $user['status'] = $request->status?1:0;
        $user['email_verified'] = $request->emailv?1:0;
        $user['sms_verified'] = $request->smsv?1:0;
        $user['role'] = $request->userRole;

        // $record = User::where('role',$user['role'])-get();

        if($request->hasFile('user_image'))
        {
            $path = 'assets/backend/image/user/pic/';

            @unlink($path.$user->picture);
            $user->picture = uniqid() . '.' . $request->user_image->getClientOriginalExtension();
            Image::make($request->user_image)->resize(300, 250)->save($path . $user->picture);
        }

        $user->save();

        $msg =  'Your Profile Updated by Admin';
        $this->sendEmail($user->email, $user->username, 'Profile Updated', $msg);
        $sms =  'Your Profile Updated by Admin';
        $this->sendSms($user->phone, $sms);

        return back()->withSuccess('User Profile Updated Successfully');
    }

    public function banusers($id = null)
    {
        // $users = User::where('status', '0')->orderBy('id', 'desc')->paginate(10);   ->where('type','$id')->get();
        //$joinedData= DB::table('users')->join('job_attributs','experience_id','=','job_attributs.id')->join('apply_jobs','users.id','=','user_id')->join('post_jobs','job_id','=','post_jobs.id')->get();
       $joinedData= DB::table('users')->where('first_name', '!=', NULL)
       ->join('apply_jobs','users.id','apply_jobs.user_id')
       ->join('post_jobs','apply_jobs.job_id','post_jobs.id')
       ->join('cv_educations','users.id','cv_educations.user_id')
       ->join('job_attributs','cv_educations.degree_level_id','job_attributs.id')
       ->get();
        // dd($joinedData);
       $joinedDataOnCareerLevel = DB::table('users')->join('job_attributs','career_level_id','=','job_attributs.id')->get();
       $joinedDataOnIndustryLevel = DB::table('users')->join('job_attributs','industry_id','=','job_attributs.id')->get();
       $joinedDataOnFunctionalArea = DB::table('users')->join('job_attributs','functional_area_id','=','job_attributs.id')->get();
       
       // dd($joinedData);
       
    //    $results = DB::table('users')
    //                  ->distinct()
    //                  ->leftJoin('apply_jobs', function($join)
    //                      {
    //                          //$join->on('experience_id', '=', 'job_attributs.id');
    //                          //$join->on('career_level_id','=', 'job_attributs.id');
    //                          //$join->on('industry_id','=', 'job_attributs.id');
    //                          //$join->on('functional_area_id','=', 'job_attributs.id');
    //                      })
    //                  ->where('job_attributs.id', '=', NULL)
    //                  ->join('apply_jobs','users.id','=','user_id')
    //                  ->join('post_jobs','job_id','=','post_jobs.id')
    //                  ->get();
                     
                    //  dd($results);

    //   dd($joinedData);
    //    dd((json_decode($joinedDataOnCareerLevel)));
    // $Arr = [];
    //  $dt1 =json_decode($joinedDataOnCareerLevel);


    //    foreach ($dt1 as $key => $value) {
    //       $Arr[$value->job_attributs]=$value->name;
    //    }

    //    dd($Arr);
        return view('backend.admin.users.banned',compact('joinedData'));
    }

    public function downloadApplicantCSV()
    {
        $pathcsv = base_path('../assets/backend/image/candidate/csv/');

        $result= DB::table('users')->where('first_name', '!=', NULL)
       ->join('apply_jobs','users.id','apply_jobs.user_id')
       ->join('post_jobs','apply_jobs.job_id','post_jobs.id')
       ->join('cv_educations','users.id','cv_educations.user_id')
       ->join('job_attributs','cv_educations.degree_level_id','job_attributs.id')
       ->get();
     
       dd($result);

       $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=output_data.csv", // <- name of file
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0",
        ];
        $columns  = ['user_id', 'user_email', 'first_name','job'];
        $callback = function () use ($result, $columns) {
            $file = fopen('php://output', 'w'); //<-here. name of file is written in headers
            fputcsv($file, $columns);
            foreach ($result as $res) {
                fputcsv($file, [$res->id, $res->skills, $res->title,$res->name]);
            }
            fclose($file);
        };

        // dd($callback);

        return response()->stream($callback, 200, $headers);

    }


    

    public function banusersWithFilters(Request $request)
    {

        $filter=$request->validate([
            'filterValue'=>''
        ]);


        // dd($filter);

        // $users = User::where('status', '0')->orderBy('id', 'desc')->paginate(10);
       $joinedData= DB::table('job_attributs')->where('type','filterValue')->get();
       
       //dd( $joinedData);
    //    ->join('job_attributs','experience_id','=','job_attributs.id')
    //    ->join('apply_jobs','users.id','=','user_id')->join('post_jobs','job_id','=','post_jobs.id')->get();
    //    $joinedDataOnCareerLevel = DB::table('users')->join('job_attributs','career_level_id','=','job_attributs.id')->get();
    //    $joinedDataOnIndustryLevel = DB::table('users')->join('job_attributs','industry_id','=','job_attributs.id')->get();
    //    $joinedDataOnFunctionalArea = DB::table('users')->join('job_attributs','functional_area_id','=','job_attributs.id')->get();

    //    dd($joinedData);
    //    dd((json_decode($joinedDataOnCareerLevel)));
    // $Arr = [];
    //  $dt1 =json_decode($joinedDataOnCareerLevel);


    //    foreach ($dt1 as $key => $value) {
    //       $Arr[$value->job_attributs]=$value->name;
    //    }

    //    dd($Arr);
        return view('backend.admin.users.banned')->with(['joinedData'=> json_decode($joinedData) , 'joinedDataOnCareerLevel' =>json_decode($joinedDataOnCareerLevel) , 'joinedDataOnIndustryLevel'=>$joinedDataOnIndustryLevel ,'joinedDataOnFunctionalArea'=>$joinedDataOnFunctionalArea]);
    }

    public function transactions()
    {
        $trans = Transaction::orderBy('id', 'desc')->paginate(15);
        return view('admin.users.trans', compact('trans'));
    }
}

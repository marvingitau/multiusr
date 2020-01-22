<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Helper\LocationResource;
use App\Http\Helper\MimeCheckRules;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\Employer;
use App\Model\JobAttributs;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class EmployerController extends Controller
{
    use LocationResource,SendEmail,SendSms;

    /**
     * @var Employer
     */
    private $employer;
    /**
     * @var JobAttributs
     */
    private $attributes;

    public function __construct(Employer $employer,JobAttributs $attributes){

        $this->employer = $employer;
        $this->attributes = $attributes;
    }

    public function index()
    {
        $pt = 'Employer List';
        $employers = $this->employer;
        if(\request()->search){
            $employers=$employers->where('username', 'like', '%' . request()->search . '%')
                ->orWhere('email', 'like', '%' . request()->search . '%')
                ->orWhere('company_name', 'like', '%' . request()->search . '%');
        }
        $employers=$employers->orderBy('id', 'desc')->paginate(20);
        return view('backend.admin.employer.index', compact('employers','pt'));
    }
    public function banusers()
    {
        $pt = 'Band Employer List';
        $employers = $this->employer;
        if(\request()->search){
            $employers=$employers->where('status',0)
                ->where(function ($q){
                    $q->orWhere('username', 'like', '%' . request()->search . '%')
                        ->orWhere('email', 'like', '%' . request()->search . '%')
                        ->orWhere('company_name', 'like', '%' . request()->search . '%');
                });

        }
        $employers=$employers->orderBy('id', 'desc')->paginate(20);
        return view('backend.admin.employer.index', compact('employers','pt'));
    }
    public function view($id)
    {
        $employer = $this->employer->findOrFail($id);
        $payment_history = /*$employer->payment()->latest()->paginate(10)*/'';
        $attributes = $this->attributes;
        $locations = $employer->getLocation();
        return view('backend.admin.employer.view', compact('employer','payment_history','attributes','locations'));
    }

    public function email($id)
    {
        $employer = $this->employer->findOrFail($id);
        return view('backend.admin.employer.email',compact('employer'));
    }

    public function emailSendToEmployee(Request $request)
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
        $this->sendEmail($to, $name, $subject, $message);
        return back()->withSuccess('Mail Sent Successfully');

    }

    public function broadcast()
    {
        return view('backend.admin.employer.broadcast');
    }

    public function broadcastEmail(Request $request)
    {
        $this->validate($request,
            [
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);

        $employers = $this->employer->where('status', '1')->get();

        foreach ($employers as $employer)
        {

            $to = $employer->email;
            $name = $employer->company_name;
            $subject = $request->subject;
            $message = $request->emailMessage;

            $this->sendEmail($to, $name, $subject, $message);
        }

        return back()->withSuccess('Mail Sent Successfully');
    }

    public function userPasschange(Request $request,$id)
    {
        $employer = $this->employer->find($id);

        $this->validate($request,
            [
                'password' => 'required|string|confirmed'
            ]);
        if($request->password == $request->password_confirmation)
        {
            $employer->password = bcrypt($request->password);
            $employer->save();

            $msg =  'Password Changed By Admin. New Password is: '.$request->password;
            $this->sendEmail($employer->email, $employer->username, 'Password Changed', $msg);
            $sms =  'Password Changed By Admin. New Password is: '.$request->password;
            $this->sendSms($employer->phone, $sms);

            return back()->with('success', 'Password Changed');
        }
        else
        {
            return back()->with('alert', 'Password Not Matched');
        }
    }
    public function locationChangeByAjax(Request $request){
        $data = $this->makeLocation($request->country_id,$request->state_id,$request->city_id);
        $result['country'] =$data['country']['option']->map(function ($item,$key) use($data){
            return [
                'id'=>$item->id,
                'text'=>$item->full_name,
                'selected'=>  optional($data['country']['selected'])->id ===$item->id?true:false
            ];
        })->prepend([
            'id'=>'',
            'text'=>'Select Country'
        ]);
        $result['state'] =$data['state']['option']->map(function ($item,$key) use($data){
            return [
                'id'=>$item->id,
                'text'=>$item->name,
                'selected'=>  optional($data['state']['selected'])->id ===$item->id?true:false
            ];
        })->prepend([
            'id'=>'',
            'text'=>'Select State'
        ]);
        $result['city'] =$data['city']['option']->map(function ($item,$key) use($data){
            return [
                'id'=>$item->id,
                'text'=>$item->name,
                'selected'=>  optional($data['city']['selected'])->id ===$item->id?true:false
            ];
        })->prepend([
            'id'=>'',
            'text'=>'Select City'
        ]);
        return response()->json($result);
    }
    public function detailsUpdate(Request $request,$id)
    {
        $this->validate($request,[
            'email'=>'email|max:191',
            'company_name'=>'max:191',
            'company_logo'=>['image',new MimeCheckRules(['png'])]
        ]);
        $employer = $this->employer->findOrFail($id);
        $employer->email = $request->email;
        $employer->company_name = $request->company_name;
        $employer->industry_id = $request->industry_id;
        $employer->ownership_type_id = $request->ownership_type_id;
        $employer->number_of_employee_id = $request->number_of_employee_id;
        $employer->description = $request->description;
        $employer->number_of_office = $request->number_of_office;
        $employer->web = $request->web;
        $employer->establish_year = $request->establish_year;
        $employer->fax = $request->fax;
        $employer->phone = $request->phone;
        $employer->country_id = $request->country_id;
        $employer->state_id = $request->state_id;
        $employer->city_id = $request->city_id;
        $employer->address = $request->address;
        if($request->hasFile('company_logo')){
            $path = 'assets/backend/image/employee/logo/';
            @unlink($path.$employer->company_logo);
            $employer->company_logo = 'company_logo_'.time().'.png';
            Image::make($request->company_logo)->save($path.$employer->company_logo);
        }
        $employer->map_script = $request->map_script;
        $employer->subscribe = $request->subscribe?1:0;
        $employer->status = $request->status?1:0;
        $employer->is_featured = $request->is_featured?1:0;
        $employer->email_verified = $request->email_verified?1:0;
        $employer->sms_verified = $request->sms_verified?1:0;
        $employer->save();
        return back()->with('success','Your profile successfully updated' );
    }



    public function transactions()
    {
        $trans = Transaction::orderBy('id', 'desc')->paginate(15);
        return view('admin.users.trans', compact('trans'));
    }
}

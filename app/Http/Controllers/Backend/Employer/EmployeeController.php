<?php

namespace App\Http\Controllers\Backend\Employer;

use App\Http\Helper\LocationResource;
use App\Http\Helper\MimeCheckRules;
use App\Http\Helper\PaymentMaster;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\ApplyJob;
use App\Model\Country;
use App\Model\Employer;
use App\Model\EmployerPackage;
use App\Model\Gateway;
use App\Model\JobAttributs;
use App\Model\Package;
use App\Model\Payment;
use App\Model\PostJob;
use App\Model\Social;
use App\Model\Transaction;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class EmployeeController extends Controller
{
use LocationResource,PaymentMaster,SendSms,SendEmail;
    /**
     * @var Package
     */
    private $package;
    /**
     * @var Employer
     */
    private $employer;
    /**
     * @var JobAttributs
     */
    private $attributes;
    /**
     * @var Country
     */
    private $country;
    /**
     * @var PostJob
     */
    private $postJob;
    /**
     * @var Gateway
     */
    private $gateway;
    /**
     * @var Social
     */
    private $social;

    public function __construct(Package $package,
                                Employer $employer,
                                JobAttributs $attributes,
                                Country $country,
                                PostJob $postJob,
                                Gateway $gateway,Social $social)
{

    $this->package = $package;
    $this->employer = $employer;
    $this->attributes = $attributes;
    $this->country = $country;
    $this->postJob = $postJob;
    $this->gateway = $gateway;
    $this->social = $social;
}

    public function index(){
        $employee = auth()->guard('employer')->user();
        $packages =  $this->package->where('package_for','employer')->where('status',true)->orderBy('short_by','ASC')->get();
        $gateway = $this->gateway->whereStatus(1)->get();
        $statistics['job_post'] = $employee->jobPost->count();
        $applu_job = ApplyJob::whereHas('job',function ($q) use($employee){
            $q->where('employer_id',$employee->id);
        });
        $statistics['apply'] = $applu_job->count();
        $statistics['candidate'] = $applu_job->get()->groupBy('user_id')->count();
        $total_chart = $this->chartData();
        return view('backend.employer.index',compact('statistics','total_chart','employee','packages','gateway'));
    }
    public function chartData(){
        $post = PostJob::whereYear('created_at', '=', date('Y'))->where('employer_id',auth()->guard('employer')->id())->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });
        $monthly_chart =collect([]);
        foreach (month_arr() as $key => $value) {
            $monthly_chart->push([
                'month' => Carbon::parse(date('Y').'-'.$key)->format('Y-m'),
                'post' =>$post->has($value)?$post[$value]->count():0,
            ]);

        }
        return response()->json($monthly_chart->toArray())->content();
    }
    public function profile(){
        $employee = auth()->guard('employer')->user();
        $attributes = $this->attributes;
        $locations = $employee->getLocation();
        return view('backend.employer.profile',compact('employee','attributes','locations'));
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
    public function profileUpdate (Request $request){
        $this->validate($request,[
            'email'=>'email|max:191',
            'company_name'=>'max:191',
            'company_logo'=>['image',new MimeCheckRules(['png'])]
        ]);

        $employer = auth()->guard('employer')->user();
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

        $employer->save();
        return back()->with('success','Your profile successfully updated' );
    }
    public function profileSocialStore(Request $request){
        $this->validate($request,[
           'company_id'=>'required|integer',
           'icon'=>'required',
           'link'=>'required'
        ]);
        $social =new $this->social;
        $social->model_type = 'employee';
        $social->model_id   = $request->company_id;
        $social->name   = $request->name;
        $social->color   = $request->color;
        $social->icon   = $request->icon;
        $social->link   = $request->link;
        $social->save();
        return back()->with('success','Save successful');
    }
    public function profileSocialUpdate(Request $request){
        $this->validate($request,[
           'company_id'=>'required|integer',
           'icon'=>'required',
           'link'=>'required'
        ]);
        $social =$this->social->findOrFail($request->id);
        $social->name   = $request->name;
        $social->color   = $request->color;
        $social->icon   = $request->icon;
        $social->link   = $request->link;
        $social->save();
        return back()->with('success','Update successful');
    }
    public function profileSocialDelete (Request $request){
        $this->validate($request,[
           'delete_id'=>'required|integer'
        ]);
        $social =$this->social->findOrFail($request->delete_id);
        $social->delete();
        return back()->with('success','Delete successful');
    }
    public function jobs(){

        $jobs = auth()->guard('employer')->user()->jobPost()->latest()->paginate(20);
        return view('backend.employer.all_jobs',compact('jobs'));
    }
    public function plan(){
      $packages =  $this->package->where('package_for','employer')->where('status',true)->orderBy('short_by','ASC')->get();
      $gateway = $this->gateway->whereStatus(1)->get();
        return view('backend.employer.plan',compact('packages','gateway'));
    }
    public function jobView($id){
        $job = $this->postJob->findOrFail($id);
        $attributes = $this->attributes;
        $locations = $job->getLocation();
        return view('backend.employer.job_view',compact('locations','attributes','job'));
    }
    public function jobEdit($id){
        $job = $this->postJob->findOrFail($id);
        $attributes = $this->attributes;
        $locations = $job->getLocation();
        return view('backend.employer.job_edit',compact('locations','attributes','job'));
    }

    public function jobPostCreate(){
        $attributes = $this->attributes;
        $locations = $this->makeLocation();
        return view('backend.employer.job_post',compact('locations','attributes'));
    }
    public function jobPostStore(Request $request){
        $this->validate($request,[
           'title'=>'required|max:191',
           'country_id'=>'nullable|integer',
           'state_id'=>'nullable|integer',
           'city_id'=>'nullable|integer',
           'salary_from'=>'nullable|numeric',
           'salary_to'=>'nullable|numeric',
           'currency_id'=>'nullable|integer',
           'salary_period_id'=>'nullable|integer',
           'career_level_id'=>'nullable|integer',
           'functional_area_id'=>'nullable|integer',
           'job_type_id'=>'nullable|integer',
           'job_shift_id'=>'nullable|integer',
           'degree_level_id'=>'nullable|integer',
           'experience_id'=>'nullable|integer',
           'expired_date'=>'nullable|date',
           'number_of_position'=>'required|integer',
        ]);
        $job_post = new $this->postJob;
        $job_post->employer_id = auth()->guard('employer')->user()->id;
        $job_post->title = $request->title;
        $job_post->description = $request->description;
        $job_post->responsibility = $request->responsibility;
        $job_post->edu_requirement = $request->edu_requirement;
        $job_post->additional_requirement = $request->additional_requirement;
        $job_post->country_id = $request->country_id;
        $job_post->state_id = $request->state_id;
        $job_post->city_id = $request->city_id;
        $job_post->salary_from = $request->salary_from?$request->salary_from:0;
        $job_post->salary_to = $request->salary_to?$request->salary_to:0;
        $job_post->currency_id = $request->currency_id;
        $job_post->salary_period_id = $request->salary_period_id;
        $job_post->career_level_id = $request->career_level_id;
        $job_post->functional_area_id = $request->functional_area_id;
        $job_post->job_type_id = $request->job_type_id;
        $job_post->job_shift_id = $request->job_shift_id;
        $job_post->degree_level_id = $request->degree_level_id;
        $job_post->experience_id = $request->experience_id;
        $job_post->preference = $request->preference;
        $job_post->number_of_position = $request->number_of_position;
        $job_post->experience_id = $request->experience_id;
        $job_post->expired_date = $request->expired_date;
        $job_post->salary_hide = $request->salary_hide?1:0;
        $job_post->save();
        $job_post->skill()->sync($request->skill);
        return back()->with('success','Job post successful');
    }

    public function jobUpdate(Request $request,$id){
        $this->validate($request,[
           'title'=>'required|max:191',
           'country_id'=>'nullable|integer',
           'state_id'=>'nullable|integer',
           'city_id'=>'nullable|integer',
           'salary_from'=>'nullable|numeric',
           'salary_to'=>'nullable|numeric',
           'currency_id'=>'nullable|integer',
           'salary_period_id'=>'nullable|integer',
           'career_level_id'=>'nullable|integer',
           'functional_area_id'=>'nullable|integer',
           'job_type_id'=>'nullable|integer',
           'job_shift_id'=>'nullable|integer',
           'degree_level_id'=>'nullable|integer',
           'experience_id'=>'nullable|integer',
           'expired_date'=>'nullable|date',
            'number_of_position'=>'required|integer',
        ]);
        $job_post =$this->postJob->findOrFail($id);
        $job_post->title = $request->title;
        $job_post->description = $request->description;
        $job_post->responsibility = $request->responsibility;
        $job_post->edu_requirement = $request->edu_requirement;
        $job_post->additional_requirement = $request->additional_requirement;
        $job_post->country_id = $request->country_id;
        $job_post->state_id = $request->state_id;
        $job_post->city_id = $request->city_id;
        $job_post->salary_from = $request->salary_from?$request->salary_from:0;
        $job_post->salary_to = $request->salary_to?$request->salary_to:0;
        $job_post->currency_id = $request->currency_id;
        $job_post->salary_period_id = $request->salary_period_id;
        $job_post->career_level_id = $request->career_level_id;
        $job_post->functional_area_id = $request->functional_area_id;
        $job_post->job_type_id = $request->job_type_id;
        $job_post->job_shift_id = $request->job_shift_id;
        $job_post->degree_level_id = $request->degree_level_id;
        $job_post->experience_id = $request->experience_id;
        $job_post->preference = $request->preference;
        $job_post->number_of_position = $request->number_of_position;
        $job_post->experience_id = $request->experience_id;
        $job_post->expired_date = $request->expired_date;
        $job_post->salary_hide = $request->salary_hide?1:0;
        $job_post->save();
        $job_post->skill()->sync($request->skill,true);
        return back()->with('success','Job post successful');
    }


    public function jobMakeShortList($apply_id){
        $employee = auth()->guard('employer')->user();
        $apply = ApplyJob::findOrFail($apply_id);
        $apply->short_list = 1;
        $apply->save();
        return back()->with('success','Short List successful');
    }
    public function jobMakeSelect($apply_id){
        $employee = auth()->guard('employer')->user();
        $apply = ApplyJob::findOrFail($apply_id);
        $apply->selected = 1;
        $apply->save();
        return back()->with('success','Selected successful');
    }
    public function viewCv($candidate_id,$apply_id){

        $user =User::findOrFail($candidate_id);
        $apply = ApplyJob::findOrFail($apply_id);
        if(!$apply->view){
            $apply->view = 1;
            $apply->save();
        }
        return view('backend.employer.cv_view',compact('user'));
    }
    public function messages(){

        return view('backend.employer.messages');
    }

    public function followers(){

        return view('backend.employer.followers');
    }

    public function candidateList($job_post_id){

        return view('backend.employer.candidate_list');
    }

    public function candidateShortList($job_post_id){

        return view('backend.employer.candidate_short_list');
    }

    /**
     * Payment for membership
     */
    public function paymentDataInsert(Request $request)
    {
        $this->validate($request,[
            'gateway' => 'required|integer',
            'plan' => 'required|integer'
        ]);

        $package =$this->package->findOrFail($request->plan);
        $amount = $package->price;
        if($amount<=0)
        {
            return back()->with('error', 'Invalid Amount');
        }
        else
        {

            $gate = Gateway::findOrFail($request->gateway);

            if(isset($gate))
            {
                if($gate->minamo <= $request->amount || $gate->maxamo >= $request->amount)
                {
                    $charge = 0;
                    $usdamo = ($amount + $charge)/$gate->rate;
                    $user =auth()->guard('employer')->user();
                    $payment = new Payment();
                    $payment->model_type = get_class($user);
                    $payment->model_id = $user->id;
                    $payment->gateway_id = $gate->id;
                    $payment->amount = $amount;
                    $payment->usd_amo = $usdamo;
                    $payment->trx = str_random(16);
                    $payment->save();

                    session()->put($this->session_name,$payment->trx);
                    session()->put('plan_id',$package->id);

                    return redirect()->route('employer.payment.preview');

                }
                else
                {
                    return back()->with('error', 'Please Follow Payment Limit');
                }
            }
            else
            {
                return back()->with('error', 'Please Select Payment gateway');
            }
        }

    }
    public function paymentPreview()
    {
        $track = session()->get('Track');
        $data = Payment::where('status',0)->where('trx',$track)->first();
        $pt = 'Deposit Preview';
        $package = $this->package->findOrFail(session()->get('plan_id'));
        return view('backend.employer.payment.preview',compact('pt','data','package'));
    }
    /**
     * PaymentMaster::class
     */
    public function cancelUrl(){
        return route('employer.dashboard');
    }

    public function successUrl(){
        if(session()->has('url.intended')){
            return session()->get('url.intended');
        }
        return route('employer.dashboard');
    }

    public function userDataUpdate($data){
        if($data->status==0){

            $data['status'] = 1;
            $data->update();
            $user = auth()->guard('employer')->user();
            $plan = $this->package->findOrFail(session()->get('plan_id'));
            $subs = new EmployerPackage();
            $subs->employer_id = $user->id;
            $subs->package_id = $plan->id;
            $subs->before_expired_date = $user->membership_expired;
            $expired = Carbon::now()->addDays($plan->days);
            $subs->after_expired_date =$expired > $user->membership_expired? $expired:$user->membership_expired;
            $subs->before_job_remaining = $user->remaining_job;
            $subs->after_job_remaining = $user->remaining_job+$plan->num_of_listing;
            $subs->meta_data = serialize($plan);
            $subs->save();


            $user->membership_expired = $subs->after_expired_date;
            $user->remaining_job = $subs->after_job_remaining;
            $user->save();
            $tran = new Transaction();
            $tran->user_id = $user->id;
            $tran->gateway_id = $data->gateway_id;
            $tran->amount = $data->amount;
            $tran->remarks = 'PAYMENT FOR SUBSCRIBE';
            $tran->trx = $data->trx;
            $tran->save();
            $msg =  'Payment Successful';
            $this->sendEmail($user->email, $user->username, 'Payment Successful', $msg);
            $sms =  'Payment Successful';
        }
    }

    public function viewPath()
    {
        return 'backend.employer.payment';
    }
}

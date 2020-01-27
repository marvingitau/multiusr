<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Helper\LocationResource;
use App\Http\Helper\MimeCheckRules;
use App\Http\SendEmail;
use App\Http\SendSms;
use App\Model\ApplyJob;
use App\Model\CvEducation;
use App\Model\CvExperience;
use App\Model\CvLanguage;
use App\Model\CvSkill;
use App\Model\JobAttributs;
use App\Model\PostJob;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use App\Mail\JobApplied; //eli
use Hash;
use Image;
use DB;
// use Exception;  

class HomeController extends Controller
{
    use SendSms,SendEmail,LocationResource;
    /**
     * @var JobAttributs
     */
    private $attributes;

    public function __construct(JobAttributs $attributes)
{
    $this->attributes = $attributes;
}

    public function index(){


       
        return view('frontend.users.dashboard');
    }

    public function disable()
    {
        $user =auth()->user();
        $option  = request()->input('dontShowAgain')?request()->input('dontShowAgain'):'0';
        $user->popStatus =  $option;
        $user->save();

        return back()->with('success','You have disabled popup');

    }

    public function profile(){
        $attributes = $this->attributes;
        $user =auth()->user();
        $locations = $user->getLocation();
        $newUser1 = CvExperience::where('user_id','=',$user->id)->first();
        $newUser2 = CvEducation::where('user_id','=',$user->id)->first();
        $newUser3 = CvSkill::where('user_id','=',$user->id)->first();
        $newUser4 = null;

        if($newUser1===null && $newUser2 === null){
            $newUser4 = 1;
        }

        // if(Auth()->user()->role=='2'){
        //     return redirect()->route('dashboard');
        // // }elseif((Auth()->user()->role =='3'){
        // //     return view('frontend.users.dashboard');
        // // }
        // // elseif((Auth()->user()->role =='1'){
    
        // // return view('frontend.users.dashboard');  
        // }

        return view('frontend.users.profile',compact('attributes','user','locations','newUser4'));
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
    public function profileUpdate(Request $request){
         $typeOfUser =$request->input('typeOfUser');
      

        $this->validate($request,[
            'first_name'=>'nullable|string|max:191',
            'last_name'=>'nullable|string|max:191',
            'father_name'=>'nullable|string|max:191',
            'mother_name'=>'nullable|string|max:191',
            'email'=>'required|email|max:191',
            'sex'=>'string',
            'marital_status_id'=>'nullable|integer',
            'country_id'=>'nullable|integer',
            'state_id'=>'nullable|integer',
            'city_id'=>'nullable|integer',
            'address'=>'nullable|string',
            'dob'=>'nullable|date',
            'nationality'=>'nullable|string',
            'permanent_address'=>'nullable|string',
            'nid_no'=>'nullable|string',
            'phone'=>'required|string',
            'experience_id'=>'nullable|integer',
            'career_level_id'=>'integer',
            'industry_id'=>'nullable|integer',
            'functional_area_id'=>'nullable|integer',
            'current_salary'=>'nullable|numeric',
            'expected_salary'=>'nullable|numeric',
            'currency_id'=>'nullable|integer',
            'picture'=>[new MimeCheckRules(['png'])]
           
        ]);



        $user = auth()->user();
        if($request->hasFile('picture')){
            $path = 'assets/backend/image/candidate/picture/';
            @unlink($path.$user->picture);
            $user->picture = 'picture_'.time().'.png';
            Image::make($request->picture)->resize(200,200)->save($path.$user->picture);
        }
        $user->first_name = $request->first_name;
        $user->father_name = $request->father_name;
        $user->last_name = $request->last_name;
        $user->mother_name = $request->mother_name;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->marital_status_id = $request->marital_status_id;
        $user->country_id = $request->country_id;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;
        $user->address = $request->address;
        $user->permanent_address = $request->permanent_address;
        $user->dob = Carbon::parse($request->dob)->format('Y-m-d');
        $user->nationality = $request->nationality;
        $user->nid_no = $request->nid_no;
        $user->phone = $request->phone;
        $user->experience_id = $request->experience_id;
        $user->career_level_id = $request->input('career_level_id');
        $user->industry_id = $request->industry_id;
        $user->functional_area_id = $request->functional_area_id;
        $user->current_salary = $request->current_salary?$request->current_salary:0;
        $user->expected_salary = $request->expected_salary?$request->expected_salary:0;
        $user->currency_id = $request->currency_id;
        $user->save();

        if(!settype($typeOfUser,'integer')) {
            $user =auth()->user();
            $locations = $this->makeLocation();
            $attributes = $this->attributes;
            $id = null; //not new user 

           // return view('frontend.users.manage_resume',compact('locations','attributes','user','typeOfUser'));
             return view(url('user/resume'),compact('locations','attributes','user','typeOfUser'));
        }
        return back()->with('success','Profile Update successful');
    }
    public function changePass(){
        return view('frontend.users.change_password');
    }
    public function changePassStore(Request $request){
        $user =auth()->user();
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'confirmed|string|different:old_password',
        ]);
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            $request->session()->flash('success', 'Password changed');
            return redirect()->back();
        } else {
            $request->session()->flash('error', 'Password does not match');
            return redirect()->back();
        }
    }

    public function myApplication($monthly = null){
        $apps = auth()->user()->applyJob(); 
        if(null !== $monthly){
            $apps=$apps->whereMonth('created_at', '=', date('m'));
        }
            $apps=$apps->latest()->paginate(20);
       
        //     foreach($apps as $key=>$value ){
        //         // dd($apps->firstItem());
        //     dd($key.' <=> '.$value->job->title);
        //     // foreach($app as $a){
        //     //     dd($a);
        //     // }
        // }

        return view('frontend.users.my_application',compact('apps'));
    }
    public function resumeView(){
        $user =auth()->user();
        return view('frontend.users.view_resume',compact('user'));
    }

    public function resume(){   // elis
        //dd($id,$slug); //elis 
        $user =auth()->user();
        $locations = $this->makeLocation();
        $attributes = $this->attributes;
        $typeOfUser = null;
        

         //  \Mail::to(auth()->user()->email)->send(  //eli
        //       new ProjectCreated($job)
        // );

        return view('frontend.users.manage_resume',compact('locations','attributes','user','typeOfUser'));
    }


    // public function resumeOne($id,$slug){
    //     //dd($id,$slug); //elis 
    //     $user =auth()->user();
    //     $locations = $this->makeLocation();
    //     $attributes = $this->attributes;

    //      //  \Mail::to(auth()->user()->email)->send(  //eli
    //     //       new ProjectCreated($job)
    //     // );

    //     return view('frontend.users.manage_resume',compact('id','user','locations','attributes','slug'));
    // }
    public function resumeUpdateSummary(Request $request){
        $user =auth()->user();
        $user->cv_summary = $request->cv_summary;
        $user->save();
        $request->session()->flash('success', 'Summary updated successful');
        return redirect()->back();
    }
    public function resumeAddExperience (Request $request){
        $this->validate($request,[
            'title'=>'required|string|max:191',
            'company'=>'required|string|max:191',
            'country_id'=>'nullable|integer',
            'city_id'=>'nullable|integer',
            'state_id'=>'nullable|integer',
            'start_date'=>'required|date',
            'end_date'=>'nullable|date'
        ]);
        $exp = new CvExperience();
        $exp->title = $request->title;
        $exp->company = $request->company;
        $exp->user_id = auth()->user()->id;
        $exp->country_id = $request->country_id;
        $exp->city_id = $request->city_id;
        $exp->state_id = $request->state_id;
        $exp->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $exp->end_date = $request->end_date?Carbon::parse($request->end_date)->format('Y-m-d'):null;
        $exp->currently_work = $request->end_date?0:1;
        $exp->description = $request->description;
        $exp->save();
        $request->session()->flash('success', 'Experience Save successful');
        return redirect()->back();
    }
    public function resumeEditExperience(Request $request,$id){
        $this->validate($request,[
            'title'=>'required|string|max:191',
            'company'=>'required|string|max:191',
            'country_id'=>'nullable|integer',
            'city_id'=>'nullable|integer',
            'state_id'=>'nullable|integer',
            'start_date'=>'required|date',
            'end_date'=>'nullable|date'
        ]);
        if(!$exp =  CvExperience::where('user_id',auth()->user()->id)->where('id',$id)->first()){
            return redirect()->back()->with('error','Wrong request given');
        }
        $exp->title = $request->title;
        $exp->company = $request->company;
        $exp->country_id = $request->country_id;
        $exp->city_id = $request->city_id;
        $exp->state_id = $request->state_id;
        $exp->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $exp->end_date = $request->end_date?Carbon::parse($request->end_date)->format('Y-m-d'):null;
        $exp->currently_work = $request->end_date?0:1;
        $exp->description = $request->description;
        $exp->save();
        return redirect()->back()->with('success','Update successful');
    }

    public function resumeDeleteExperience($id){
        if(!$exp =  CvExperience::where('user_id',auth()->user()->id)->where('id',$id)->first()){
            return redirect()->back()->with('error','Wrong request given');
        }
        $exp->delete();
        return redirect()->back()->with('success','Delete successful');
    }




    public function resumeAddEducation (Request $request){
        $this->validate($request,[
            'major_subject_id'=>'nullable|integer',
            'degree_title'=>'required|string|max:191',
            'institute'=>'required|string|max:191',
            'result'=>'required|string|max:191',
            'passing_year'=>'nullable|digits:4|integer|min:1900',
            'result_type_id'=>'nullable|integer',
            'degree_level_id'=>'nullable|integer',
            'degree_types_id'=>'nullable|integer',
            'country_id'=>'nullable|integer',
            'city_id'=>'nullable|integer',
            'state_id'=>'nullable|integer',
        ]);

        $edu = new CvEducation();
        $edu->degree_title = $request->degree_title;
        $edu->institute = $request->institute;
        
        $edu->user_id = auth()->user()->id;
        $edu->country_id = $request->country_id;
        $edu->city_id = $request->city_id;
        $edu->state_id = $request->state_id;
        $edu->degree_level_id = $request->degree_level_id;
        $edu->major_subject_id = $request->major_subject_id;
        $edu->passing_year = $request->passing_year;
        $edu->result = $request->result;
        $edu->result_type_id = $request->result_type_id;
        $edu->save();
        $request->session()->flash('success', 'Education Save successful');
        return redirect()->back();
    }
    public function resumeEditEducation (Request $request,$id){
        $this->validate($request,[
            'major_subject_id'=>'nullable|integer',
            'degree_title'=>'required|string|max:191',
            'institute'=>'required|string|max:191',
            'result'=>'required|string|max:191',
            'passing_year'=>'nullable|digits:4|integer|min:1900',
            'result_type_id'=>'nullable|integer',
            'degree_level_id'=>'nullable|integer',
            'degree_types_id'=>'nullable|integer',
            'country_id'=>'nullable|integer',
            'city_id'=>'nullable|integer',
            // 'state_id'=>'nullable|integer',
        ]);

        if(!$edu =  CvEducation::where('user_id',auth()->user()->id)->where('id',$id)->first()){
            return redirect()->back()->with('error','Wrong request given');
        }
        $edu->degree_title = $request->degree_title;
        $edu->institute = $request->institute;
        $edu->country_id = $request->country_id;
        $edu->city_id = $request->city_id;
        $edu->state_id = $request->state_id;
        $edu->degree_level_id = $request->degree_level_id;
        $edu->major_subject_id = $request->major_subject_id;
        $edu->passing_year = $request->passing_year;
        $edu->result = $request->result;
        $edu->result_type_id = $request->result_type_id;
        $edu->save();
        $request->session()->flash('success', 'Education Update successful');
        return redirect()->back();
    }
    public function resumeDeleteEducation($id){
        if(!$edu =  CvEducation::where('user_id',auth()->user()->id)->where('id',$id)->first()){
            return redirect()->back()->with('error','Wrong request given');
        }
        $edu->delete();
        return redirect()->back()->with('success','Delete successful');
    }

    public function resumeAddSkill (Request $request){
        $this->validate($request,[
            'skills_id'=>'required|integer',
            'experience_id'=>'required|integer',
        ]);
        $skill = new CvSkill();
        $skill->user_id = auth()->user()->id;
        $skill->skills_id = $request->skills_id;
        $skill->experience_id = $request->experience_id;
        $skill->save();
        $request->session()->flash('success', 'Skill Save successful');
        return redirect()->back();
    }
    public function resumeEditSkill (Request $request,$id){
        $this->validate($request,[
            'skills_id'=>'required|integer',
            'experience_id'=>'required|integer',
        ]);

        if(!$skill =  CvSkill::where('user_id',auth()->user()->id)->where('id',$id)->first()){
            return redirect()->back()->with('error','Wrong request given');
        }
        $skill->skills_id = $request->skills_id;
        $skill->experience_id = $request->experience_id;
        $skill->save();
        $request->session()->flash('success', 'Skill Update successful');
        return redirect()->back();
    }
    public function resumeDeleteSkill($id){
        if(!$skill =  CvSkill::where('user_id',auth()->user()->id)->where('id',$id)->first()){
            return redirect()->back()->with('error','Wrong request given');
        }
        $skill->delete();
        return redirect()->back()->with('success','Delete successful');
    }public function resumeAddLanguage (Request $request){
    $this->validate($request,[
        'language_id'=>'required|integer',
        'language_level_id'=>'required|integer',
    ]);
    $lang = new CvLanguage();
    $lang->user_id = auth()->user()->id;
    $lang->language_id = $request->language_id;
    $lang->language_level_id = $request->language_level_id;
    $lang->save();
    $request->session()->flash('success', 'Language Save successful');
    return redirect()->back();
}
    public function resumeEditLanguage (Request $request,$id){
        $this->validate($request,[
            'language_id'=>'required|integer',
            'language_level_id'=>'required|integer',
        ]);

        if(!$lang =  CvLanguage::where('user_id',auth()->user()->id)->where('id',$id)->first()){
            return redirect()->back()->with('error','Wrong request given');
        }
        $lang->language_id = $request->language_id;
        $lang->language_level_id = $request->language_level_id;
        $lang->save();
        $request->session()->flash('success', 'Language Update successful');
        return redirect()->back();
    }
    public function resumeDeleteLanguage($id){
        if(!$skill =  CvLanguage::where('user_id',auth()->user()->id)->where('id',$id)->first()){
            return redirect()->back()->with('error','Wrong request given');
        }
        $skill->delete();
        return redirect()->back()->with('success','Delete successful');
    }
    public function resumeUploadFile(Request $request){

        $this->validate($request,[
            'file'=>['required',new MimeCheckRules(['pdf'])],
           
            'letter' => 'required',
        ]);
        if($request->hasFile('file') || $request->hasFile('letter')){
            $path = 'assets/backend/image/candidate/cv/';
            $name = 'cv_pdf_'.auth()->user()->id.'.'.$request->file('file')->getClientOriginalExtension();
            @unlink($path.'/'.$name);
            $request->file('file')->move($path,$name);
            $path1 = 'assets/backend/image/candidate/letters/';
            $name1 = 'cover_letter_'.auth()->user()->id.'.'.$request->file('letter')->getClientOriginalExtension();
            @unlink($path1.'/'.$name1);
            $request->file('letter')->move($path1,$name1);

            

        return redirect()->route('user.apply_job')->with('success','File Upload successful');
          
           
        }

        return redirect()->back()->with('error','File Upload failed');
    }
// elis
    // public function resumeUploadFileCoverLetter(Request $request){
    //     $this->validate($request,[
    //         'file'=>['required'],
    //         'file.*'=>'size:20000'
    //     ]);
    //     if($request->hasFile('file')){
    //         $path = 'assets/backend/image/candidate/letters/';
    //         $name = 'cover_letter_'.auth()->user()->id.$request->file('letter')->getClientOriginalExtension();
    //         @unlink($path.'/'.$name);
    //         $request->file->move($path,$name);
    //         return redirect()->back()->with('success','File Upload successful');
    //     }
    //     return redirect()->back()->with('error','File Upload failed');
    // }

public function formApplication($id){
    $attributes = $this->attributes;
        return view('frontend.job_app_form',compact('attributes','id'));
}

public function userData(User $user,CvEducation $cvEd,Request $request,$id)
{

    // dd($id);
    $attrib = request()->validate([
        'firstName'=>'required',
        'lastName'=>'',
        'phone'=>'',
        'alt_phone'=>'',
        'email'=>'unique:users',
        'dob'=>'',
        'current_employer'=>'',
        'current_role'=>'',  
        'experience'=>'',
        'info_acknowledgement'=>'',
        'education'=>'',
        'institute'=>'',
        'other_degreeAndCollege'=>'',
        'other_qualifications'=>'',
    ]);
    // dd([ 'firstName'=>$attrib['firstName'], 'lastName'=>$attrib['lastName'] ]);   experience_id

    // try {
        $res=$user->create([ 'first_name'=>$attrib['firstName'], 'last_name'=>$attrib['lastName'],
        'email'=>$attrib['email'],"phone"=>$attrib['phone'], 'experience_id'=>$attrib['experience'],
        'info_acknowledgement'=>$attrib['info_acknowledgement'],'current_role'=>$attrib['current_role'],
        'current_employer'=>$attrib['current_employer'],'dob'=>$attrib['dob'],'alt_phone'=>$attrib['alt_phone']
        ]);
        $res1 = $cvEd->create([ 'user_id'=>$res['id'], 'degree_level_id'=>$attrib['education'],'institute'=>$attrib['institute'],
        'other_degreeAndCollege'=>$attrib['other_degreeAndCollege'],'other_qualifications'=>$attrib['other_qualifications'],
        ]);
        // dd($res1); //USER ID
        
    //   } catch (\Illuminate\Database\QueryException $e) {
        //   return redirect()->back()->with('integrity',$e->errorInfo);
    //   }




    $apply = new ApplyJob();
    $apply->job_id = $id;
    $apply->user_id = $res['id'];
   
    $apply->cv_type='pdf';
    $apply->expected_salary = 0;

    $apply->save();

    if($request->hasFile('cv') ){
        $path = 'assets/backend/image/candidate/cv/';
        $name = $attrib['firstName'].'_cv'.'.'.$request->file('cv')->getClientOriginalExtension();
        @unlink($path.'/'.$name);
        $request->file('cv')->move($path,$name);
  
    }



    // \Mail::to(auth()->user()->email)->send(  //eli
    //           new JobApplied($job)
    // );

    return redirect()->back()->withSuccess("good");
    
}

    public function applyJob($id){
        if( !$job = PostJob::where('id',$id)->first()){
            return view('frontend.error');
        }
        if($job->isApplyByUser()){
            return back()->with('error','You already applied this job');
        }
    
        return view('frontend.users.apply_form',compact('job'));

        
       

    }
    public function applyJobStore(Request $request,$id){



        $this->validate($request,[
            'file'=>['',new MimeCheckRules(['pdf'])],
            'letter' => ['',new MimeCheckRules(['pdf'])],
        ]);
        if($request->hasFile('file') || $request->hasFile('letter')){
            $path = 'assets/backend/image/candidate/cv/';
            $name = 'cv_pdf_'.auth()->user()->id.'.'.$request->file('file')->getClientOriginalExtension();
            @unlink($path.'/'.$name);
            $request->file('file')->move($path,$name);
            $path1 = 'assets/backend/image/candidate/letters/';
            $name1 = 'cover_letter_'.auth()->user()->id.'.'.$request->file('letter')->getClientOriginalExtension();
            @unlink($path1.'/'.$name1);
            $request->file('letter')->move($path1,$name1);


            // return redirect()->route('user.apply_job')->with('success','File Upload successful');
        }

        // return redirect()->back()->with('error','File Upload failed');


        $this->validate($request,[
           'cv_type' =>'null',
           'expected_salary' =>'null|numeric|min:1'
        ]);

    //    if( !$job = PostJob::currentJob()->where('id',$id)->first()){
    //        return view('frontend.error');
    //    }
    if( !$job = PostJob::where('id',$id)->first()){
        return view('frontend.error');
    }
        if($job->isApplyByUser()){
            return back()->with('error','You already applied this job');
        }
        $apply = new ApplyJob();
        $apply->job_id = $id;
        $apply->user_id = auth()->user()->id;
        // $apply->cv_type = $request->cv_type;
       // $apply->cv_type = $request->file('file')->getClientOriginalExtension();
       $apply->cv_type='pdf';
       
    //    if($request->file('file')!==null){
    //     $apply->cv_type=file('file')->getClientOriginalExtension();
    //    }
        // $apply->expected_salary = $request->expected_salary;
        $apply->expected_salary = 0;

        $apply->save();



        \Mail::to(auth()->user()->email)->send(  //eli
                  new JobApplied($job)
        );
    
         return redirect()->route('job.view',[$id,str_slug($job->title)])->with('success','Job apply Successful');


        $user =auth()->user();
        $locations = $this->makeLocation();
        $attributes = $this->attributes;
        $slug = str_slug($job->title);

        // ,compact('id','slug','user','locations','attributes')


       // return redirect()->route('user.resumeOne',[$id,$slug]);
    }


}

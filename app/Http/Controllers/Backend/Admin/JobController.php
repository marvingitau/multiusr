<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Model\JobAttributs;
use App\Model\PostJob;
use App\Model\Admin;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
// use Illuminate\Http\Response;
use DB;

class JobController extends Controller
{
    /**
     * @var PostJob
     */
    private $job;
    /**
     * @var JobAttributs
     */
    private $attributes;

    public function __construct(PostJob $job,JobAttributs $attributes)
    {

        $this->job = $job;
        $this->attributes = $attributes;
        $this->middleware('auth')->except(['index']);
    }
    public function index(){
     
         $jobs = $this->job->latest()->paginate(20);
        
        // $date = date("Y-m-d h:i:s");
        // $jobs=$this->job->whereDate('expired_date',">",$date)->paginate(20);
        

        // $jobs = DB::table('post_jobs')->whereDate('expired_date',">",$date)->get();
    //    dd($jobs);
        // dd($date);
        // $now = Carbon::now();
        // $jobs=PostJob::where('user_id', Auth::user()->id)
        // ->where('expired_date', '>', $now)
        // ->get();   
        // dd($jobs);
        return view('backend.admin.manage_job.index',compact('jobs','attributes'));
    }
    public function create(Request $request) // el function
    {
       // $attr = $this->attributes;
      // dd($this->attributes->getAttr('functional_area'));
        // $attributes = $this->attributes::all();

        return view('backend.admin.manage_job.create')->with(['attributes'=>$this->attributes,'job'=>$this->job]);
    }
    public function store()
    {
        $succ= request()->validate([
            'title'=>['required'],
            'description'=>['required'],
            'degree_level_id'=>['required'],
            'experience_id' => ['required'],
            'degree_level_id' => ['nullable'],
            'number_of_position' => ['required'],
            'preference' => [],
            'job_shift_id' => [],
            'job_type_id' => 'nullable',
            'functional_area_id' => [],
            'career_level_id' => ['required'],
            'city_id' => [],
            'country_id' => [],
            'expired_date'=>[],
            // 'required_skill'=>[], 
            'skills'=>[]
            

            

            // 'title'=> ['required' ,'min:3'],
            // 'description' => ['required' ,'min:3']  // => this used here for conditions
        ]);
        // $skill=request()->input('skill');
        // $skill_arr=[];
        // foreach ($skill as $skil) {
        //     array_push($skill_arr,$skil);
        // }
        // dd(serialize($skill_arr));
        

        //return $succ;
        $artr=PostJob::create($succ+['employer_id'=>0]);
        
        // dd($artr);


       

         return redirect('/admin/jobs');
    }

    public function view($id){
        $job = $this->job->findOrFail($id);
        // $application = ApplyJob::all();
        // dd($application);
        $attributes = $this->attributes;
        $locations = $job->getLocation();
        return view('backend.admin.manage_job.view',compact('locations','attributes','job'));
    }
    public function edit($id,JobAttributs $attributes){
        $job = $this->job->findOrFail($id);  // post_job table  elis
         //dd($job);
        $attributes = $this->attributes;
        //   dd($attributes->all());
        $locations = $job->getLocation();  // array of country city state
        // dd($locations);
        return view('backend.admin.manage_job.edit')->with(['locations'=> $job->getLocation(),'attributes'=>$this->attributes,'job'=>$this->job->findOrFail($id)]);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'title'=>'required|max:191',
            // 'country_id'=>'nullable|integer',
            // 'state_id'=>'nullable|integer',
            // 'city_id'=>'nullable|integer',
            // 'salary_from'=>'nullable|numeric',
            // 'salary_to'=>'nullable|numeric',
            // 'currency_id'=>'nullable|integer',
            // 'salary_period_id'=>'nullable|integer',
            // 'career_level_id'=>'nullable|integer',
            // 'functional_area_id'=>'nullable|integer',
            // 'job_type_id'=>'nullable|integer',
            // 'job_shift_id'=>'nullable|integer',
            // 'degree_level_id'=>'nullable|integer',
            // 'experience_id'=>'nullable|integer',
            // 'expired_date'=>'nullable|date',
            // 'number_of_position'=>'required|integer',
        ]);
        $job_post =$this->job->findOrFail($id);
        $job_post->title = $request->title;
        $job_post->description = $request->description;
        $job_post->country_id = $request->country_id?$request->country_id:0;
        $job_post->state_id = $request->state_id?$request->state_id:0;
        $job_post->city_id = $request->city_id?$request->city_id:0;
        $job_post->salary_from = $request->salary_from?$request->salary_from:0;
        $job_post->salary_to = $request->salary_to?$request->salary_to:0;
        $job_post->currency_id = $request->currency_id?$request->currency_id:0;
        $job_post->salary_period_id = $request->salary_period_id?$request->salary_period_id:0;
        $job_post->career_level_id = $request->career_level_id?$request->career_level_id:0;
        $job_post->functional_area_id = $request->functional_area_id?$request->functional_area_id:0;
        $job_post->job_type_id = $request->job_type_id?$request->job_type_id:0;
        $job_post->job_shift_id = $request->job_shift_id?$request->job_shift_id:0;
        $job_post->degree_level_id = $request->degree_level_id?$request->degree_level_id:0;
        $job_post->experience_id = $request->experience_id?$request->experience_id:0;
        $job_post->preference = $request->preference? $request->preference:null;
        $job_post->number_of_position = $request->number_of_position?$request->number_of_position:0;
        $job_post->experience_id = $request->experience_id?$request->experience_id:0;
        $job_post->expired_date = $request->expired_date;
        $job_post->salary_hide = $request->salary_hide?1:0;
        $job_post->save();
        $job_post->skill()->sync($request->skill,true);
        return back()->with('success','Job post successful');
    }
    public function viewCv($candidate_id){

        $user =User::findOrFail($candidate_id);
        return view('backend.admin.manage_job.cv_view',compact('user'));
    }
    
     public function downloadDocs(Request $request,$id){
       
        $pathcv = base_path('../assets/backend/image/candidate/cv/');
        $pathcl =  base_path('../assets/backend/image/candidate/letters/');


        
        //  dd(public_path().'/cv_pdf_'.auth()->user()->id.'.pdf'); // 
        if($request->cvChoice != null ){
            $headers = [
                'Content-Type' => 'application/pdf',
             ];
                
            return response()->download($pathcv.'cv_pdf_'.$id.'.pdf');
    
        }
        if($request->clChoice != null ){
            $headers = array(
                  'Content-Type => application/pdf',
                //   'Content-Type: application/txt',
                //   'Content-Type: application/docx',
                );
            return response()->download($pathcl.'cover_letter_'.$id.'.pdf');
        }

        //else{
            
        // }



        // $pathcv = asset('assets/backend/image/candidate/cv');
        // $pathcl = asset('assets/backend/image/candidate/letters');

        //  $statu = $this->cv_pdf($id);

        // s dd( $statu);
        
        //  dd(public_path()); // 
        // if($request->cvChoice != null ){
        //     $headers = array(
        //           'Content-Type: application/pdf',
        //         );
                
        //     return response()->download($pathcv, 'cv_pdf_'.auth()->user()->id.'.pdf', $headers);
    
        // } elseif($request->clChoice != null ){
        //     $headers = array(
        //           'Content-Type: application/pdf',
        //           'Content-Type: application/txt',
        //           'Content-Type: application/docx',
        //         );
        //     return response()->download($pathcl, 'cover_letter_'.auth()->user()->id.'.pdf', $headers);
        // }else{
            
        // }
        
         
        //  $pathcv="/home/kmrccoke/jobs.kmrc.co.ke/assets/backend/image/candidate/cv";
        // $pathcl="/home/kmrccoke/jobs.kmrc.co.ke/assets/backend/image/candidate/letter";
        
        //  $pathcv=public_path();
        // // $pathcl=public_path()."/storage/letter";
        
        // $path = 'assets/backend/image/candidate/cv/';
        // $name = 'cv_pdf_'.$this->id.'.pdf';
        // if(file_exists(asset($path.'/'.$name))){
        //   return  asset($path.'/'.$name);
        // }
        // return null;
        
       
        
       
    
        // return Response::download($file, 'filename.pdf', $headers);
    
    }

    public function cv_pdf($id){
        $path = base_path('assets/backend/image/candidate/cv');
        $name = 'cv_pdf_'.$id.'.pdf';
        if(file_exists(asset($path.'/'.$name))){
          return  asset($path.'/'.$name);
        }
        return null;
    }
    
    public function changeStatus($id){
        $job_post =$this->job->findOrFail($id);
        $job_post->status =  $job_post->status?0:1;
        $job_post->save();
        return back()->with('success','Job '.$job_post->status?'Approved':'Not Approved'.' successful');
    }
    
    public function destroy($id){
        $this->job->findOrFail($id)->delete();
      
        return back()->with('success','Job Deleted successful');
    }


    public function createNewUser()
    {
        return view('backend.admin.users.createUser');
    }

    public function storeNewUser(Admin $admin,Request $request)
    {
        // dd($admin::all());
        $succ= request()->validate([
            'username'=>['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
            'phone' => ['required'],
            'address' => ['nullable'],
            'email' => ['required'],
            'sex' => [],
            'role_id' => [],
        ]);

        $admin->username=$request->username;
        $admin->first_name=$request->first_name;
        $admin->last_name=$request->last_name;
        $admin->phone=$request->phone;
        $admin->email=$request->email;
        $admin->address=$request->address;
        $admin->role_id=$request->role_id;
        $admin->sex=$request->sex;
        $admin->password= bcrypt($request->password);
        $admin->save();

        
        // Admin::create($succ);
        return back();

    }

    public function deleteUser(Admin $admin,Request $request)
    {
        // dd($admin::all());
        $succ= request()->validate([
            'first_name'=>['required'],
            'last_name'=>['required'],
            'role_id' => ['required'],
        ]);

    
        $admin->first_name=$request->first_name;
        $admin->last_name=$request->last_name;
        $admin->role_id=$request->role_id;
        
        $admin->where('first_name','=',$request->first_name)->where('role_id','=',$request->role_id)->where('last_name','=',$request->last_name)->delete();

        
        // Admin::create($succ);
        return back()->with('success','Deletion Compelete');

    }

}

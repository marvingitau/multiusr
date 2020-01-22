<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Helper\JobSearch;
use App\Http\Helper\LocationResource;
use App\Http\SendEmail;
use App\Model\BlogCategory;
use App\Model\BlogPost;
use App\Model\Employer as Company;
use App\Model\Employer;
use App\Model\GeneralSetting;
use App\Model\JobAttributs;
use App\Model\PostJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;


// elis //
use App\Model\CvEducation;
use App\Model\CvExperience;
use App\Model\CvLanguage;
use App\Model\User;

//end of elis //

class HomeController extends Controller
{ 
    use SendEmail,LocationResource;
    /**
     * @var JobAttributs
     */
    private $jobAttributs;
    /**
     * @var Company
     */
    private $company;
    /**
     * @var PostJob
     */
    private $postJob;

    public function __construct(JobAttributs $jobAttributs,Company $company,PostJob $postJob)
    {
        $this->jobAttributs = $jobAttributs;
        $this->company = $company;
        $this->postJob = $postJob;
    }

    public function index(){
        $country_option =$this->makeLocation()['country']['option']->map(function ($item,$key){
            return [
                'id'=>$item->id,
                'text'=>$item->full_name
            ];
        })->prepend([
            'id'=>'',
            'text'=>'Country'
        ]);
        $blogs = BlogPost::latest()->take(3)->get();
        $category = $this->jobAttributs->getAttr('functional_area');
        // $job_posts = $this->postJob->latest()->take(4)->get()->map(function ($item,$key){
        //     $company = $item->employer;
        //     $location = [];
        //     if($company->country){
        //         $location[]= $company->country->full_name;
        //     }
        //     if($company->state){
        //         $location[]= $company->state->name;
        //     }
        //     if($company->city){
        //         $location[]= $company->city->name;
        //     }
        //     return [
        //         'id'=>$item->id,
        //         'title'=>$item->title,
        //         'image'=>$company->company_logo(),
        //         'company_name'=>$company->company_name,
        //         'company_url'=>route('company_details',$company->id),
        //         'location'=>implode(' , ',$location),
        //         'url'=>route('job.view',[$item->id,str_slug($item->title)]),
        //         'posted_time'=>$item->created_at->diffForHumans(),
        //         'type'=>optional($item->type)->name,
        //         'description'=>str_limit($item->description,200),
        //     ];
        // });

        $job_posts = PostJob::latest()->take(5)->get();
        // dd($job_posts);
        return view('frontend.home',compact('country_option','category','blogs','job_posts'));
    }
    public function searchByKeyWord(Request $request){
        session()->put('job_keyword',[
            'keyword'=>$request->keyword,
            'country'=>$request->country,
            'state'=>$request->state,
            'city'=>$request->city,
            'functional_area'=>$request->functional_area
        ]);
        return redirect()->route('job');
    }
    public function job(){

    //     $default_keyword = [
    //         'keyword'=>'',
    //         'country'=>'',
    //         'state'=>'',
    //         'city'=>'',
    //         'functional_area'=>'',
    //     ];
    //     if(session()->has('job_keyword')){
    //         $default_keyword = session()->get('job_keyword');
    //         session()->forget('job_keyword');
    //     }

    //     $country_option =$this->makeLocation()['country']['option']->map(function ($item,$key){
    //         return [
    //             'id'=>$item->id,
    //             'text'=>$item->full_name
    //         ];
    //     })->prepend([
    //         'id'=>'',
    //         'text'=>'Country'
    //     ]);
    //     $category['functional_area'] = $this->jobAttributs->getAttr('functional_area')->map(function ($item,$key) {
    //         return [
    //             'id'=>$item->id,
    //             'text'=>$item->name
    //         ];
    //     })->prepend([
    //         'id'=>'',
    //         'text'=>'Functional Area'
    //     ]);
    //     $category['industry'] = $this->jobAttributs->getAttr('industry')->map(function ($item,$key) {
    //         return [
    //             'id'=>$item->id,
    //             'text'=>$item->name
    //         ];
    //     })->prepend([
    //         'id'=>'',
    //         'text'=>'Job Category'
    //     ]);
    //    $filter = $this->getFilterOption();
    $date = date("Y-m-d h:i:s");
    $job_posts = PostJob::latest()->where('status','=','1')->take(5)->whereDate('expired_date',">",$date)->get();
    //  $job_posts = PostJob::latest()->take(4)->get();
    //  dd($filter); 
     
       // return view('frontend.jobs',compact('country_option','category','filter','default_keyword','job_posts'));
        return view('frontend.jobs',compact('job_posts'));
    }
    public function jobView($id){
        $job = PostJob::findOrFail($id);
        // $company = $job->employer;
        $location_city = [1=>'Nairobi',2=>'Thika',3=>'Kisumu'];
        $city='';
        if($job->city_id !== null){
            $city=$location_city[$job->city_id];
        }

        // try {
        //     $location_city[$job->city];
        // } catch (OutOfRangeException $e) {
        //     $location_city='Nairobi';
        // }
    

        // if($company->country){
        //     $location[]= $company->country->full_name;
        // }
        // if($company->state){
        //     $location[]= $company->state->name;
        // }
        // if($company->city){
        //     $location[]= $company->city->name;
        // }
        // dd($city);
        $user =auth()->user();
        // dd($user);

        $newUserAlpha = 1; //not new  user

        //checking whether its a first time usr
        $fName = null;
        $firstTimeUser=User::where('first_name','=',$fName)->latest()->first();

        // dd(session('username'));

        if($user !== null){
        $newUser1 = CvExperience::where('user_id','=',$user->id)->first();
        $newUser2 = CvEducation::where('user_id','=',$user->id)->first();
        // $newUser3 = CvSkill::where('user_id','=',$user->id)->first();
        

        if($newUser1===null && $newUser2 === null){
            $newUserAlpha = null;
        }
        }

         return view('frontend.job_details',compact('job','city','newUserAlpha'));

       // redirect()->route('frontend.job_details',compact('job','city'))->with('success','Job apply Successful');
    }

        public function formApplication()
        {
            dd('awaiting form page');
        }


    // public function companyDetails ($company_id){
    //     $company = $this->company->findOrFail($company_id);
    //     return view('frontend.company_details',compact('company'));
    // }
    public function locationChangeByAjax(Request $request){
        $data = $this->makeLocation($request->country_id,$request->state_id,$request->city_id);
        $result['state'] =$data['state']['option']->map(function ($item,$key) use($data){
            return [
                'id'=>$item->id,
                'text'=>$item->name
            ];
        })->prepend([
            'id'=>'',
            'text'=>'State'
        ]);
        $result['city'] =$data['city']['option']->map(function ($item,$key) use($data){
            return [
                'id'=>$item->id,
                'text'=>$item->name
            ];
        })->prepend([
            'id'=>'',
            'text'=>'City'
        ]);
        return response()->json($result);
    }
    public function searchJob(Request $request){
        $filter = collect([]);
        if($request->filter){
            foreach ($request->filter as $key=>$value){
                $json_d = json_decode($value,true);
                $data =[];
                if($filter->has($json_d['key'])){
                 $data =    $filter->pull($json_d['key']);
                }
                $data[] = $json_d['id'];
                $filter->put($json_d['key'],$data);
            }
        }
        return response()->json($this->getJobPost($filter));
    }
    public function getJobPost(Collection $filter){
        $data = (new JobSearch())->filter($this->postJob->currentJob(),$filter)->paginate(8);
      return  $this->makePaginate($data,$data->map(function ($item,$key){
          $company = $item->employer;
          $location = [];
          if($company->country){
              $location[]= $company->country->full_name;
          }
          if($company->state){
              $location[]= $company->state->name;
          }
          if($company->city){
              $location[]= $company->city->name;
          }
          $is_add = ($key+1)%3;
            return [
                'id'=>$item->id,
                'title'=>$item->title,
                'image'=>$company->company_logo(),
                'company_name'=>$company->company_name,
                'company_url'=>route('company_details',$company->id),
                'location'=>implode(' , ',$location),
                'url'=>route('job.view',[$item->id,str_slug($item->title)]),
                'posted_time'=>$item->created_at->diffForHumans(),
                'type'=>optional($item->type)->name,
                'description'=>str_limit($item->description,200),
                'is_add'=>$is_add==0?true:false
            ];
        }));
    }
    public function makePaginate($paginate_data,$map_data){
       $meta_data =  $paginate_data->toArray();
       unset($meta_data['data']);
        return [
            'meta_data'=>$meta_data,
            'data'=>$map_data
        ];
    }
    public function getFilterOption(){
        $arr = [
           'experience'=>'experience',
           'Job Type'=>'type',
           'Career Level'=>'career_level',
           'Job Shift'=>'shift',
           'Skill'=>'skills',
           'Industry'=>'industry',
        ];
        foreach ($arr as $key => $value){
            if($value === 'company'){
                $filter[$key] = [
                    'option'=>$this->company->get()->map(function ($item,$key) {
                        return [
                            'id'=>$item->id,
                            'text'=>$item->company_name,
                            'value'=>''
                        ];
                    }),
                    'id'=>$value,
                    'icon'=>'<i class="fa fa-building"></i>',
                ];
            }else{
                $filter[$key] = [
                    'option'=>$this->jobAttributs->getAttr($value)->map(function ($item,$key) {
                        return [
                            'id'=>$item->id,
                            'text'=>$item->name,
                            'value'=>''
                        ];
                    }),
                    'id'=>$value,
                    'icon'=>$this->jobAttributs->types()[$value]['icon'],
                ];
            }
        }
        return $filter;
    }
    public function faq(){
        return view('frontend.faq');
    }
    public function contact(){
        return view('frontend.contact');
    }
    public function contactSubmit(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'subject'=>'required',
            'message' => 'required|max:1024',
        ]);

        $settings = GeneralSetting::first();

        $template = $settings->email_message;
        $from = $request->email;
        if($settings->en == 1){
            $headers = "From: $request->name <$from> \r\n";
            $headers .= "Reply-To: $request->name <$from> \r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $mm = str_replace("{{name}}",'I am '.$request->name,$template);
            $message = str_replace("{{message}}",$request->message,$mm);
            @mail($settings->email, 'Contact Us Mail', $message, $headers);
        }
        return redirect()->back()->with('success', 'Mail Send Successfully');
    }
    public function blog($cat=null){
        $blogs = BlogPost::latest();
            if(null !== $cat){
                $cat = BlogCategory::findOrFail($cat);
                $blogs=$blogs->where('cat_id',$cat->id);
            }
        $blogs=$blogs->paginate(9);
        return view('frontend.blog',compact('blogs','cat'));
    }
    public function blogDetails($id,$slug){
        $blog = BlogPost::findOrFail($id);
        $blog->increment('hit');
        $categories = BlogCategory::get();
        $latest_blogs = BlogPost::whereNotIn('id',[$id])->latest()->take(7)->get();
        return view('frontend.blog_details',compact('blog','categories','latest_blogs'));
    }
}

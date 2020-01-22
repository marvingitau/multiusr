<?php

namespace App\Http\Controllers\Frontend\Kmrc;

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
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use App\Mail\JobApplied; //eli
use Hash;
use Image;
use DB;



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
        return view('frontend.Kmrc.dashboard');
    }
}



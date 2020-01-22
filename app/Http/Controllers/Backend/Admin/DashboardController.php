<?php

namespace App\Http\Controllers\Backend\Admin;


use App\Model\Admin;
use App\Model\ApplyJob;
use App\Model\PostJob;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
{

}

    public function index(){
        $total_chart = $this->chartData();
        return view('backend.admin.index',compact('total_chart'));
    }
    public function chartData(){
        $job_post = PostJob::whereYear('created_at', '=', date('Y'))->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });
        $employer = ApplyJob::whereYear('created_at', '=', date('Y'))->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });
        //  $appliedjobs = ApplyJob::all()->count();
        //  dd($appliedjobs);
        $seeker = User::whereYear('created_at', '=', date('Y'))->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });
        $monthly_chart =collect([]);
        foreach (month_arr() as $key => $value) {
            $monthly_chart->push([
                'month' => Carbon::parse(date('Y').'-'.$key)->format('Y-m'),
                'job_post' =>$job_post->has($value)?$job_post[$value]->count():0,
                // 'employer' =>$employer->has($value)?$employer[$value]->count():0,
                // 'employer' =>$appliedjobs,
                'seeker' =>$seeker->has($value)?$seeker[$value]->count():0,
            ]);

        }
        return response()->json($monthly_chart->toArray())->content();
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobAttributs extends Model
{
    use SoftDeletes;
    public static function types(){
        $data = collect([]);        
        $data->put('experience',['label'=>'Job Experience','icon'=>'<i class="fa fa-bar-chart-o"></i>']);        
        $data->put('career_level',['label'=>'Career Level','icon'=>'<i class="fa fa-bar-chart-o"></i>']);
        $data->put('language_level',['label'=>'Language Level','icon'=>'<i class="fa fa-line-chart"></i>']);
        $data->put('career_level',['label'=>'Career Level','icon'=>'<i class="fa fa-bar-chart-o"></i>']);        
        $data->put('skills',['label'=>'Job Skills','icon'=>'<i class="fa fa-bar-chart"></i>']);
        $data->put('functional_area',['label'=>'Functional Area','icon'=>'<i class="fa fa-arrows"></i>']);
        $data->put('industry',['label'=>'Industry','icon'=>'<i class="fa fa-building"></i>']);
        $data->put('experience',['label'=>'Job Experience','icon'=>'<i class="fa fa-bar-chart-o"></i>']);
        $data->put('skills',['label'=>'Job Skills','icon'=>'<i class="fa fa-bar-chart"></i>']);
        $data->put('type',['label'=>'Job Type','icon'=>'<i class="fa fa-briefcase"></i>']);
        // $data->put('shift',['label'=>'Job Shift','icon'=>'<i class="fa fa-black-tie"></i>']);
        $data->put('degree_level',['label'=>'Degree Level','icon'=>'<i class="fa fa-arrow-circle-up"></i>']);
        $data->put('degree_types',['label'=>'Degree Types','icon'=>'<i class="fa fa-file-text"></i>']);
        $data->put('major_subject',['label'=>'Major Subject','icon'=>'<i class="fa fa-book"></i>']);
        $data->put('result_type',['label'=>'Result Type','icon'=>'<i class="fa fa-graduation-cap"></i>']);
        $data->put('marital_status',['label'=>'Marital Status','icon'=>'<i class="fa fa-mars-double"></i>']);
        // $data->put('ownership_types',['label'=>'Ownership Types','icon'=>'<i class="fa fa-user-circle"></i>']);
        $data->put('salary_periods',['label'=>'Salary Periods','icon'=>'<i class="fa fa-money"></i>']);
        // $data->put('number_of_employee',['label'=>'Number of Employees','icon'=>'<i class="fa fa-user"></i>']);
        // $data->put('currency',['label'=>'Currency','icon'=>'<i class="fa fa-dollar"></i>']);        
        $data->put('language_level',['label'=>'Language Level','icon'=>'<i class="fa fa-line-chart"></i>']);
        $data->put('language',['label'=>'Language','icon'=>'<i class="fa fa-language"></i>']);
        return $data;
    }
    public static function getAttr($type){
        return JobAttributs::where('type',$type)->get();
    }

}

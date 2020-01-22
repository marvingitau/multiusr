<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CvEducation extends Model
{

    protected $fillable=['user_id','degree_level_id']; //elis

    protected $table = 'cv_educations';

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function major(){
        return $this->belongsTo(JobAttributs::class,'major_subject_id');
    }
    public function address(){
        $addre = [];
        if($this->country){
            $addre[] =    $this->country->full_name;
        }
        if($this->state){
            $addre[] =    $this->state->name;
        }
        if($this->city){
            $addre[] =    $this->city->name;
        }
        return $addre;
    }
    public function degreeLevel(){
        return $this->belongsTo(JobAttributs::class,'degree_level_id');
    }
    public function resultType(){
        return $this->belongsTo(JobAttributs::class,'result_type_id');
    }
}

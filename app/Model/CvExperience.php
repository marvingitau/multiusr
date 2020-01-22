<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CvExperience extends Model
{
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id');
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
    public function experienceByMonth(){
        $start = Carbon::parse($this->start_date);
        $end = $this->end_date?Carbon::parse($this->end_date):Carbon::now();

       return $start->diff($end)->y;
    }
    public function experienceByYear(){
        $month = 123;

    }

}

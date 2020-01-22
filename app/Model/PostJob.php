<?php

namespace App\Model;

use App\Http\Helper\LocationResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PostJob extends Model
{
    protected $guarded =[];
    use LocationResource;
   public function skill(){
       return $this->belongsToMany(JobAttributs::class,'job_post_pivot_skill','job_post_id','skill_id')
           ->where('type','skills');
   }
   public function employer(){
       return $this->belongsTo(Employer::class,'employer_id');
   }
    public function getLocation(){
        return $this->makeLocation($this->country_id,$this->state_id,$this->city_id);
    }
    public function currency(){
        return $this->belongsTo(JobAttributs::class,'currency_id');
    }
    public function type(){
        return $this->belongsTo(JobAttributs::class,'job_type_id');
    }
    public function shift(){
        return $this->belongsTo(JobAttributs::class,'job_shift_id');
    }
    public function career_level(){
        return $this->belongsTo(JobAttributs::class,'career_level_id');
    }
    public function functional_area(){
        return $this->belongsTo(JobAttributs::class,'functional_area_id');
    }
    public function degree_level(){
        return $this->belongsTo(JobAttributs::class,'degree_level_id');
    }
    public function experience(){
        return $this->belongsTo(JobAttributs::class,'experience_id');
    }
    public function scopeCurrentJob($query){
       return $query->where('expired_date','>=',Carbon::now())->where('status',1);
    }
    public function applyJob(){
       return $this->hasMany(ApplyJob::class,'job_id');
    }
    public function isApplyByUser(){
       $status = false;
      if($user = auth()->user()){
         if($apply_job =  $this->applyJob->where('user_id',$user->id)->count()){
             $status = true;
         }
      }
      return $status;
    }
    public function isCurrent(){
        if($this->expired_date >= Carbon::now()){
            return true;
        }
        return false;
    }
    public function preferences(){
       if($this->preference === 'M'){
           return 'Male';
       }elseif ($this->preference === 'F'){
           return 'Female';
       }else{
           return 'N/a';
       }
    }

    // public function requiredskills()
    // {
    //     return $this->hasMany(RequiredSkills::class);
    // }

}

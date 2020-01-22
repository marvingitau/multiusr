<?php

namespace App\Model;

use App\Http\Helper\LocationResource;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,LocationResource,SoftDeletes;

    protected $appends =['full_name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','first_name','last_name','phone','experience_id'  //elis
    ];
    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }
    public function picture_path(){
        if($this->picture === null){
            return asset('assets/backend/image/no-img.png');
        }
        return asset('assets/backend/image/candidate/picture/'.$this->picture);
    }
    public function cv_pdf(){
        $path = 'assets/backend/image/candidate/cv/';
        $name = 'cv_pdf_'.$this->id.'.pdf';
        if(file_exists(asset($path.'/'.$name))){
          return  asset($path.'/'.$name);
        }
        return null;
    }
    public function sex(){
        if($this->sex === 'M'){
            return 'Male';
        }
        if($this->sex === 'F'){
            return 'Female';
        }
        if($this->sex === 'O'){
            return 'Other';
        }
    }
    public function applyJob(){
        return $this->hasMany(ApplyJob::class,'user_id');
    }
    public function payment(){
        return $this->hasMany(Payment::class,'user_id')->whereStatus(1);
    }
    public function cvExperience(){
        return $this->hasMany(CvExperience::class,'user_id');
    }
    public function cvEducation(){
        return $this->hasMany(CvEducation::class,'user_id');
    }
    public function cvSkill(){
        return $this->hasMany(CvSkill::class,'user_id');
    }
    public function cvLanguage(){
        return $this->hasMany(CvLanguage::class,'user_id');
    }
    public function getLocation(){
        return $this->makeLocation($this->country_id,$this->state_id,$this->city_id);
    }
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
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

<?php

namespace App\Model;

use App\Http\Helper\LocationResource;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Employer extends Authenticatable
{
    use Notifiable,LocationResource;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['membership_expired'];
    protected $fillable = [
        'username', 'email', 'password',
    ];
    public function company_logo(){
        if($this->company_logo === null){
            return asset('assets/backend/image/employee/logo/no-img.png');
        }
        return asset('assets/backend/image/employee/logo/'.$this->company_logo);
    }
    public function socials()
    {
        return $this->morphMany(Social::class,'model');
    }
   public function isSupExpired(){
       if($this->membership_expired === null){
           return true;
       }
       if(Carbon::now() > $this->membership_expired) return true;
       return false;
   }
   public function currentPackage(){
        return EmployerPackage::where([
            'employer_id'=>$this->id,
        ])->orderBy('id','desc')->first();
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
    public function getLocation(){
        return $this->makeLocation($this->country_id,$this->state_id,$this->city_id);
    }
    public function jobPost(){
        return $this->hasMany(PostJob::class,'employer_id');
    }
    public function payment(){
        return $this->morphTo(Payment::class,'user_id')->whereStatus(1);
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

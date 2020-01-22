<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CvSkill extends Model
{
    public function skill(){
        return $this->belongsTo(JobAttributs::class,'skills_id');
    }
    public function experience(){
        return $this->belongsTo(JobAttributs::class,'experience_id');
    }
}

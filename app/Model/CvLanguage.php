<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CvLanguage extends Model
{
    public function language(){
        return $this->belongsTo(JobAttributs::class,'language_id');
    }
    public function languageLevel(){
        return $this->belongsTo(JobAttributs::class,'language_level_id');
    }
}

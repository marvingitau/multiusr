<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    public function job(){
        return $this->belongsTo(PostJob::class,'job_id');
    }
    public function candidate(){
        return $this->belongsTo(User::class,'user_id');
    }
}

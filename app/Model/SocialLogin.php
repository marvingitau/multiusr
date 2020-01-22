<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    public function user(){
        return $this->morphTo('model');
    }
}

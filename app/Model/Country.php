<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function state(){
        return $this->hasMany(State::class,'country_id')->orderBy('short_by','asc');
    }
}

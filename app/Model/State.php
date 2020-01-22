<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function city(){
        return $this->hasMany(City::class,'state_id')->orderBy('short_by','asc');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}

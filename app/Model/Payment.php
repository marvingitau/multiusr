<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
public function user(){
    return $this->morphTo('model');
}
public function gateway(){
    return $this->belongsTo(Gateway::class,'gateway_id');
}
}

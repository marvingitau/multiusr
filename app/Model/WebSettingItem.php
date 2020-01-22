<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WebSettingItem extends Model
{
    public function teamSocial()
    {
        return $this->morphMany(Social::class,'model');
    }
    public function delete()
    {
        $this->teamSocial()->delete();
        return parent::delete();
    }
}

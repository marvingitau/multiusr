<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    public function socialable()
    {
        return $this->morphTo();
    }
}

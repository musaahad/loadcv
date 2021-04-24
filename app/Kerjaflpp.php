<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kerjaflpp extends Model
{
    protected $guarded = [];
    protected $table = "kerjaflpp";

    public function flpps()
    {
        return $this->belongsTo(Flpps::class, 'flpps_id');    
    }
}



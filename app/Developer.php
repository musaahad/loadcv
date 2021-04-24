<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public $table = "developer";

    
    public function flpps()
    {
        return $this->hasMany(Flpps::class);
    }
    public function vercall()
    {
        return $this->hasMany(Vercall::class);
    }
}

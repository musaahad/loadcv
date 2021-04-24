<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public $table = "bus";
    
    public function internal()
    {
        return $this->hasMany(Internal::class);
    }
    public function flpps()
    {
        return $this->hasMany(Flpps::class);
    }
    public function vercall()
    {
        return $this->hasMany(Vercall::class);
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}

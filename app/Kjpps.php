<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kjpps extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    public $table = "kjpps";

 
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}

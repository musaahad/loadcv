<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $guarded = [];
    protected $table = "reviews";

    
    public function kjpps()
    {
        return $this->belongsTo(Kjpps::class);    
    }
    public function bus()
    {
       return $this->belongsTo(Bus::class,'bus_id');    
    }
    public function users()
    {
      return $this->belongsTo(User::class,'users_id');    
    }
    public function kerjareview()
    {
      return $this->hasMany(Kerjareview::class);    
    }
}

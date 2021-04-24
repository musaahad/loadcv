<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internal extends Model
{
    protected $guarded = [];
    protected $table = "internal";

    
    
    public function bus()
    {
       return $this->belongsTo(Bus::class, 'bus_id');    
    }
    
    public function users()
    {
      return $this->belongsTo(User::class, 'users_id');    
    }
    public function kerjainternal()
    {
      return $this->hasMany(Kerjainternal::class);    
    }
    
  
}

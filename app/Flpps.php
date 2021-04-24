<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flpps extends Model
{
    protected $guarded = [];
    public $table = "flpps";

    public function developers()
    {
        return $this->belongsTo(Developer::class, 'developer_id');    
    }
    public function bus()
    {
       return $this->belongsTo(Bus::class,'bus_id');    
    }
    public function users()
    {
      return $this->belongsTo(User::class, 'users_id');    
    }
    public function kerjaflpp()
    {
      return $this->hasMany(Kerjaflpp::class);    
    }
    
}

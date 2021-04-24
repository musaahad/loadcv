<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vercall extends Model
{
    protected $guarded = [];
    protected $table = "vercall";

    
    public function developer()
    {
        return $this->belongsTo(Developer::class, 'developer_id');    
    }
    public function bus()
    {
       return $this->belongsTo(Bus::class,'bus_id');    
    }
    
}

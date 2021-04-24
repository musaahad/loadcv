<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanah extends Model
{
    protected $guarded = [];
    protected $table = "tanah";

    public function kerjareviews()
    {
        return $this->belongsTo(Kerjareview::class, 'kerjareview_id');    
    }

    public function kerjainternals()
    {
        return $this->belongsTo(Kerjainternal::class, 'kerjainternal_id');    
    }
    
}

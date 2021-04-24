<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesinspl extends Model
{
    protected $guarded = [];
    protected $table = "mesinspl";

    public function kerjareviews()
    {
        return $this->belongsTo(Kerjareview::class, 'kerjareview_id');    
    }

    public function kerjainternals()
    {
        return $this->belongsTo(Kerjainternal::class, 'kerjainternal_id');    
    }
}

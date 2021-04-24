<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kerjainternal extends Model
{
    protected $guarded = [];
    protected $table = "kerjainternal";

    public function internals()
    {
        return $this->belongsTo(Internal::class, 'internal_id');    
    }
    public function datapasar()
    {
        return $this->hasMany(Datapasar::class);
    }
    public function tanah()
    {
        return $this->hasMany(Tanah::class);
    }
    public function bangunan()
    {
        return $this->hasMany(Bangunan::class);
    }
    public function mesinspl()
    {
        return $this->hasMany(Mesinspl::class);
    }
}

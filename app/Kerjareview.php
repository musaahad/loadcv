<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kerjareview extends Model
{
    protected $guarded = [];
    protected $table = "kerjareview";

    public function reviews()
    {
        return $this->belongsTo(Reviews::class, 'reviews_id');    
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

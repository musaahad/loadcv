<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datapasar extends Model
{
    protected $guarded = [];
    protected $table = "datapasar";

    public function kerjareviews()
    {
        return $this->belongsTo(Kerjareview::class, 'kerjareview_id');    
    }

    public function kerjainternals()
    {
        return $this->belongsTo(Kerjainternal::class, 'kerjainternal_id');    
    }
    // public function getGambar()
    // {
    //     if(substr($this->gambar,0,5)== "https"){
    //         return $this->gambar;
    //     }
    //     if ($this->gambar){
    //         return asset($this->gambar);
    //     }
    //     return 'https://via.placeholder.com/150x200.png?text=No+Cover';
    // }

}

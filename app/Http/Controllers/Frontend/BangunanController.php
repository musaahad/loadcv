<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Reviews;
use App\Kerjareview;
use App\Bangunan;
use App\Internal;

class BangunanController extends Controller
{
    public function create(Request $request) 
    {
        $pengguna = Auth::user()->id;
        $alamat = $request->alamat;
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                        //->join('datapasar','kerjareview.id','=','datapasar.kerjareview_id')
                        ->where('users_id',$pengguna)
                        ->where('alamat',$alamat)
                        ->where('status','!=','done')->first();

        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                        ->where('users_id',$pengguna)
                        ->where('alamat',$alamat)
                        ->where('status','!=','done')->first();

        if($kerjareviews != null){
            Bangunan::create([
                'kerjareview_id' =>$kerjareviews->id,
            ]);

            return redirect()->route('bangunan.show')->with('toast','Data sudah ditambah, silahkan lengkapi/edit');
       }

            Bangunan::create([
                'kerjainternal_id' =>$kerjainternals->id,
            ]);
            
       return redirect()->route('bangunan.showinternal')->with('toast','Data sudah ditambah, silahkan lengkapi/edit');
    }

    public function show()
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $bangunans = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('bangunan','kerjareview.id','=','bangunan.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
       
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return view('frontend.bangunan.show',[
            'title' => 'Daftar Bangunan',
            //'reviews'=> $reviews,
            'bangunans' => $bangunans,
            'kerjareviews' => $kerjareviews,
        ]);
        
    }

    public function showinternal()
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $bangunans = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->join('bangunan','kerjainternal.id','=','bangunan.kerjainternal_id')
                            ->where('status','!=','done')
                            ->get();
       
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return view('frontend.bangunan_internal.show',[
            'title' => 'Daftar Bangunan',
            //'reviews'=> $reviews,
            'bangunans' => $bangunans,
            'kerjainternals' => $kerjainternals,
        ]);
        
    }

    public function edit(Bangunan $bangunan)
    {
        
        return view('frontend.bangunan.create', [
            'title' => 'Edit Rincian Bangunan',
            'bangunan'=> $bangunan,
       
        ]);
    }

    public function editinternal(Bangunan $bangunan)
    {
        
        return view('frontend.bangunan_internal.create', [
            'title' => 'Edit Rincian Bangunan',
            'bangunan'=> $bangunan,
       
        ]);
    }

    public function data()
    {
        $pengguna = Auth::user()->id;
    
        $bangunans = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->join('bangunan','kerjareview.id','=','bangunan.kerjareview_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($bangunans)
                            ->addColumn('npb1',function(Reviews $model){
                                  $npb1 = $model->npb1;
                                return number_format($npb1);
                                })
                            ->addColumn('nlb1',function(Reviews $model){
                                $nlb1 = $model->nlb1;
                                return number_format($nlb1);
                                })
                            ->addColumn('luas_bangunan2',function(Reviews $model){
                                    $lb2 = $model->luas_bangunan2;
                                    return number_format($lb2);
                                })
                            ->addColumn('action','frontend.bangunan.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function datainternal()
    {
        $pengguna = Auth::user()->id;
    
        $bangunans = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->join('bangunan','kerjainternal.id','=','bangunan.kerjainternal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($bangunans)
                            ->addColumn('npb1',function(Internal $model){
                                  $npb1 = $model->npb1;
                                return number_format($npb1);
                                })
                            ->addColumn('nlb1',function(Internal $model){
                                $nlb1 = $model->nlb1;
                                return number_format($nlb1);
                                })
                            ->addColumn('luas_bangunan2',function(Internal $model){
                                    $lb2 = $model->luas_bangunan2;
                                    return number_format($lb2);
                                })
                            ->addColumn('action','frontend.bangunan_internal.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function update(Request $request, Bangunan $bangunan)
    {
        $npb1 = str_replace('.','',$request->npb1);
        $nlb1 = str_replace('.','',$request->nlb1);
        if (($request->tgl_imb) != null){
            $a = date_create($request->tgl_imb);
            $tgl_imb = date_format($a,"Y/m/d");
        } else $tgl_imb = null;
        
        
        $this->validate($request,[
            
            'luas_bangunan2'=> 'required',
            'nama' =>'required',
            'npb1'=>'required',
            'nlb1'=>'required',
            'catatan1'=>'required',

        ]);
        $bangunan->update([
            
            'luas_bangunan2'=>$request->luas_bangunan2,
            'nama'=>$request->nama,
            'no_imb' => $request->no_imb,
            'tgl_imb' => $tgl_imb,
            'kondisi_bangunan' => $request->kondisi_bangunan,
            'npb1' =>$npb1,
            'nlb1'=>$nlb1,
            'catatan1'=>$request->catatan1,
        ]);
        
        return redirect()->route('bangunan.show')->with('toast','data sudah terupdate'); 
        
    }

    public function updateinternal(Request $request, Bangunan $bangunan)
    {
        $npb1 = str_replace('.','',$request->npb1);
        $nlb1 = str_replace('.','',$request->nlb1);

        if (($request->tgl_imb) != null){
            $a = date_create($request->tgl_imb);
            $tgl_imb = date_format($a,"Y/m/d");
        } else $tgl_imb = null;
        
        $this->validate($request,[
            
            'luas_bangunan2'=> 'required',
            'nama' =>'required',
            'npb1'=>'required',
            'nlb1'=>'required',
            'catatan1'=>'required',

        ]);
        $bangunan->update([
            
            'luas_bangunan2'=>$request->luas_bangunan2,
            'nama'=>$request->nama,
            'no_imb' => $request->no_imb,
            'tgl_imb' => $tgl_imb,
            'kondisi_bangunan' => $request->kondisi_bangunan,
            'npb1' =>$npb1,
            'nlb1'=>$nlb1,
            'catatan1'=>$request->catatan1,
            'struktur' => $request->struktur,
            'atap' => $request->atap,
            'plafon' => $request->plafon,
            'dinding' => $request->dinding,
            'pintu_jendela' => $request->pintu_jendela,
            'lantai' => $request->lantai,
        ]);
        
        return redirect()->route('bangunan.showinternal')->with('toast','data sudah terupdate'); 
        
    }
    public function destroy(Bangunan $bangunan)
    {
        $bangunan->delete();

        return redirect()->route('bangunan.show')->with('toast','Data sudah terhapus'); 
    }

    public function destroyinternal(Bangunan $bangunan)
    {
        $bangunan->delete();

        return redirect()->route('bangunan.showinternal')->with('toast','Data sudah terhapus'); 
    }
}

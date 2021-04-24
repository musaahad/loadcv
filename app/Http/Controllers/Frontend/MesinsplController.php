<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Reviews;
use App\Kerjareview;
use App\Mesinspl;
use App\Internal;

class MesinsplController extends Controller
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
                Mesinspl::create([
                'kerjareview_id' =>$kerjareviews->id,
            ]);
                
            return redirect()->route('tanah.show')->with('toast','Data sudah ditambah, silahkan lengkapi/edit');
            }
        
            Mesinspl::create([
            'kerjainternal_id' =>$kerjainternals->id,
            ]);
        
            return redirect()->route('mesinspl.showinternal')->with('toast','Data sudah ditambah, silahkan lengkapi/edit');
    }

    public function show()
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $mesinspls = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('mesinspl','kerjareview.id','=','mesinspl.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
       
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return view('frontend.mesinspl.show',[
            'title' => 'Daftar Mesin & SPL',
            //'reviews'=> $reviews,
            'bangunans' => $mesinspls,
            'kerjareviews' => $kerjareviews,
        ]);
        
    }

    public function showinternal()
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $mesinspls = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->join('mesinspl','kerjainternal.id','=','mesinspl.kerjainternal_id')
                            ->where('status','!=','done')
                            ->get();
       
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return view('frontend.mesinspl_internal.show',[
            'title' => 'Daftar Mesin & SPL',
            //'reviews'=> $reviews,
            'bangunans' => $mesinspls,
            'kerjainternals' => $kerjainternals,
        ]);
        
    }

    public function edit(Mesinspl $mesinspl)
    {
        
        return view('frontend.mesinspl.create', [
            'title' => 'Edit Rincian Mesin & SPL',
            'mesinspl'=> $mesinspl,
       
        ]);
    }

    public function editinternal(Mesinspl $mesinspl)
    {
        
        return view('frontend.mesinspl_internal.create', [
            'title' => 'Edit Rincian Mesin & SPL',
            'mesinspl'=> $mesinspl,
       
        ]);
    }

    public function data()
    {
        $pengguna = Auth::user()->id;
    
        $mesinspls = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->join('mesinspl','kerjareview.id','=','mesinspl.kerjareview_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($mesinspls)
                            ->addColumn('npm1',function(Reviews $model){
                                $npm1 = $model->npm1;
                                return number_format($npm1);
                            })
                            ->addColumn('nlm1',function(Reviews $model){
                                $nlm1 = $model->nlm1;
                                return number_format($nlm1);
                            })
                            ->addColumn('action','frontend.mesinspl.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function datainternal()
    {
        $pengguna = Auth::user()->id;
    
        $mesinspls = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->join('mesinspl','kerjainternal.id','=','mesinspl.kerjainternal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($mesinspls)
                            ->addColumn('npm1',function(Internal $model){
                                $npm1 = $model->npm1;
                                return number_format($npm1);
                            })
                            ->addColumn('nlm1',function(Internal $model){
                                $nlm1 = $model->nlm1;
                                return number_format($nlm1);
                            })
                            ->addColumn('action','frontend.mesinspl_internal.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function update(Request $request, Mesinspl $mesinspl)
    {
        $npm1 = str_replace('.','',$request->npm1);
        $nlm1 = str_replace('.','',$request->nlm1);
        $x = date_create($request->tgl_invoice);
        $tgl_invoice = date_format($x,"Y/m/d");
        
        $this->validate($request,[
            
            'nama_mesin'=> 'required',
            'spesifikasi' =>'required',
            'npm1'=>'required',
            'nlm1'=>'required',
            'catatan2'=>'required',
            'satuan' => 'required',
            'kondisi_spl' => 'required',
            

        ]);
        $mesinspl->update([
            
            'nama_mesin'=>$request->nama_mesin,
            'spesifikasi'=>$request->spesifikasi,
            'npm1' =>$npm1,
            'nlm1'=>$nlm1,
            'kondisi_spl' =>$request->kondisi_spl,
            'satuan' => $request->satuan,
            'catatan2'=>$request->catatan2,
            'invoice' =>$request->invoice,
            'tgl_invoice' => $tgl_invoice,
        ]);
        
        return redirect()->route('mesinspl.show')->with('toast','data sudah terupdate'); 
        
    }

    public function updateinternal(Request $request, Mesinspl $mesinspl)
    {
        $npm1 = str_replace('.','',$request->npm1);
        $nlm1 = str_replace('.','',$request->nlm1);
        $x = date_create($request->tgl_invoice);
        $tgl_invoice = date_format($x,"Y/m/d");
        
        $this->validate($request,[
            
            'nama_mesin'=> 'required',
            'spesifikasi' =>'required',
            'npm1'=>'required',
            'nlm1'=>'required',
            'catatan2'=>'required',
            'satuan' => 'required',
            'kondisi_spl' => 'required',
            

        ]);
        $mesinspl->update([
            
            'nama_mesin'=>$request->nama_mesin,
            'spesifikasi'=>$request->spesifikasi,
            'npm1' =>$npm1,
            'nlm1'=>$nlm1,
            'kondisi_spl' =>$request->kondisi_spl,
            'satuan' => $request->satuan,
            'catatan2'=>$request->catatan2,
            'invoice' =>$request->invoice,
            'tgl_invoice' => $tgl_invoice,
        ]);
        
        return redirect()->route('mesinspl.showinternal')->with('toast','data sudah terupdate'); 
        
    }
    public function destroy(Mesinspl $mesinspl)
    {
        $mesinspl->delete();

        return redirect()->route('mesinspl.show')->with('toast','Data sudah terhapus'); 
    }

    public function destroyinternal(Mesinspl $mesinspl)
    {
        $mesinspl->delete();

        return redirect()->route('mesinspl.showinternal')->with('toast','Data sudah terhapus'); 
    }
}

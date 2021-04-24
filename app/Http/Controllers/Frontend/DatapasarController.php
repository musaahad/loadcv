<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Datapasar;
use App\Kerjareview;
use App\Reviews;
use Illuminate\Support\Facades\Auth;
use App\Province;
use App\Internal;
use App\Villages;
use App\City;
use App\Districs;
use Illuminate\Support\Facades\Storage;

class DatapasarController extends Controller
{
    
    public function index()
    {
        return view('frontend.datapasar.index',[
            'title' => 'Data Pembanding',
        ]);
    }
    
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
            if (Datapasar::where('kerjareview_id',$kerjareviews->id)->count()>= 3){
                return redirect()->route('datapasar.show')
                                ->with('toast','oopss! Jumlah data objek tsb sudah pas 3, silahkan pilih alamat lain');
                } 
                    
            
            Datapasar::create([
                'kerjareview_id' =>$kerjareviews->id,
            ]);
            
            return redirect()->route('datapasar.show')->with('toast','Data sudah ditambah, silahkan lengkapi/edit');
        }
        if (Datapasar::where('kerjainternal_id',$kerjainternals->id)->count()>= 3){
            return redirect()->route('datapasar.showinternal')
                            ->with('toast','oopss! Jumlah data objek tsb sudah pas 3, silahkan pilih alamat lain');
            } 
                
        
        Datapasar::create([
            'kerjainternal_id' =>$kerjainternals->id,
        ]);
        
        return redirect()->route('datapasar.showinternal')->with('toast','Data sudah ditambah, silahkan lengkapi/edit');
        
    }

    public function show()
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $datapasars = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('datapasar','kerjareview.id','=','datapasar.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
       
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return view('frontend.datapasar.show',[
            'title' => 'Data Pembanding',
            //'reviews'=> $reviews,
            'datapasars' => $datapasars,
            'kerjareviews' => $kerjareviews,
        ]);
        
    }

    public function showinternal()
    {
        
 
        $pengguna = Auth::user()->id;
    
        $datapasars = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->join('datapasar','kerjainternal.id','=','datapasar.kerjainternal_id')
                            ->where('status','!=','done')
                            ->get();
       
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return view('frontend.datapasar_internal.show',[
            'title' => 'Data Pembanding',
            //'reviews'=> $reviews,
            'datapasars' => $datapasars,
            'kerjainternals' => $kerjainternals,
        ]);
        
    }

    public function edit( Datapasar $datapasar)
    {      
        
        return view('frontend.datapasar.create', [
            'title' => 'Edit data pembanding',
            'datapasar'=> $datapasar,
            'provinces' => Province::pluck('nama','id'),
            //'provinces' => $provinces,
            //'cities'=> $cities,
        ]);
    }


    public function editinternal( Datapasar $datapasar)
    {      
        
        return view('frontend.datapasar_internal.create', [
            'title' => 'Edit data pembanding',
            'datapasar'=> $datapasar,
            'provinces' => Province::pluck('nama','id'),
           
        ]);
    }

    public function detail( Datapasar $datapasar)
    {      
        
       
        return view('frontend.datapasar.detail', [
            'title' => 'Detail Data Pembanding',
            'datapasar'=> $datapasar,
           
        ]);
    }

    

    
    public function dataall()
    {
       
    
        // $datapasars = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
        //                     ->join('datapasar','kerjareview.id','=','datapasar.kerjareview_id')
        //                     ->orderBy('tanggal_data', 'DESC')->get();

        $datapasars = Datapasar::orderBy('tanggal_data', 'DESC')->get();
                           
                             

        return datatables()->of($datapasars)
                            ->addColumn('harga_penawaran',function(Datapasar $model){
                                return number_format($model->harga_penawaran);
                            })
                            ->addColumn('action','frontend.datapasar.action2')
                            // ->addColumn('PIC',function(Datapasar $model){
                                
                            //     return $model->users->name;
                            // })
                            ->addColumn('tanggal_data',function(Datapasar $model){
                               
                                return date('d M Y',strtotime($model->tanggal_data));
                            }) 
                            ->editColumn('gambar', function(Datapasar $model){
                                return '<img src="'.asset('assets/data_gambar/'.$model->gambar).'"height="100px" width="100px">';
                            })
                            ->addIndexColumn()
                            ->rawColumns(['gambar'])
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function data()
    {
        $pengguna = Auth::user()->id;
    
        $datapasars = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->join('datapasar','kerjareview.id','=','datapasar.kerjareview_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($datapasars)
                            ->addColumn('action','frontend.datapasar.action')
                            ->addColumn('harga_penawaran',function(Reviews $model){
                                return number_format($model->harga_penawaran);
                            })
                            ->editColumn('gambar', function(Reviews $model){
                               return '<img src="'.asset('assets/data_gambar/'.$model->gambar).'"height="100px" width="100px">';
                              // return $model->gambar;
                            })
                            ->addIndexColumn()
                            ->rawColumns(['gambar','action'])
                            //->rawColumns(['action'])
                            ->toJson();
    }

    public function datainternal()
    {
        $pengguna = Auth::user()->id;
    
        $datapasars = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->join('datapasar','kerjainternal.id','=','datapasar.kerjainternal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($datapasars)
                            ->addColumn('action','frontend.datapasar_internal.action')
                            ->addColumn('harga_penawaran',function(Internal $model){
                                return number_format($model->harga_penawaran);
                            })
                            ->editColumn('gambar', function(Internal $model){
                               return '<img src="'.asset('assets/data_gambar/'.$model->gambar).'"height="100px" width="100px">';
                              // return $model->gambar;
                            })
                            ->addIndexColumn()
                            ->rawColumns(['gambar','action'])
                            //->rawColumns(['action'])
                            ->toJson();
    }

    public function update(Request $request, Datapasar $datapasar)
    {
        $harga = str_replace('.','',$request->harga_penawaran);
        $x = date_create($request->tanggal_data);
        $tanggal = date_format($x,"Y/m/d");

        if(is_numeric($request->villages1) == false){
            $villages1 = ($request->villages1);
        } else  $villages1 = Villages::where('id',$request->villages1)->first()->nama;

        if(is_numeric($request->province1) == false){
            $province1 = ($request->province1);
        } else $province1 = Province::where('id',$request->province1)->first()->nama;
        
        if(is_numeric($request->city1) == false){
            $city1 = ($request->city1);
        } else  $city1 = City::where('id',$request->city1)->first()->nama;
        
        if(is_numeric($request->districs1) == false){
            $districs1 = ($request->districs1);
        } else  $districs1 = Districs::where('id',$request->districs1)->first()->nama;
        
        $this->validate($request,[
            
            'keterangan1'=> 'required',
            'tanggal_data'=>'required',
            'peruntukan1' =>'required',
            'penjual'=>'required',
            'notelp'=>'required',
            'legalitas1'=>'required',
            'luas_tanah1' =>'required',
            'bentuk_tanah1' =>'required',
            'posisi1' =>'required',
            'frontage1'=>'required',
            'lebar_jalan1'=>'required',
            'koordinat1'=>'required',
            'jarak_aktiva'=>'required',
            'alamat1'=>'required',
            
            'harga_penawaran' =>'required',
            'gambar' => 'file|image'

        ]);
        // $gambar = null;

        // if ($request->hasFile('gambar')){
        //     $gambar = $request->file('gambar')->store('/assets/gambar');
        // };

        
        
        $nama_gambar = $datapasar->gambar;
    
            // isi dengan nama folder tempat kemana file diupload
      

        if ($request->file('gambar')){
            Storage::delete($nama_gambar);
           
            $file = $request->file('gambar');
            $nama_gambar = time()."-".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/data_gambar';
            $file->move($tujuan_upload,$nama_gambar);
        }
      
        $datapasar->update([
            
            'tanggal_data'=>$tanggal,
            'peruntukan1' =>$request->peruntukan1,
            'penjual'=>$request->penjual,
            'notelp'=>$request->notelp,
            'legalitas1'=>$request->legalitas1,
            'luas_tanah1' =>$request->luas_tanah1,
            'luas_bangunan1' =>$request->luas_bangunan1,
            'bentuk_tanah1' =>$request->bentuk_tanah1,
            'jarak_aktiva'=> $request->jarak_aktiva,
            'posisi1' =>$request->posisi1,
            'frontage1'=>$request->frontage1,
            'lebar_jalan1'=>$request->lebar_jalan1,
            'koordinat1'=>$request->koordinat1,
            'alamat1'=>$request->alamat1,
            'villages1'=>$villages1,
            'districs1'=>$districs1,
            'city1'=>$city1,
            'province1'=>$province1,
            'harga_penawaran' =>$harga,
            'keterangan1'=>$request->keterangan1,
            'gambar' => $nama_gambar,
        ]);
        
        return redirect()->route('datapasar.show')->with('toast','data sudah terupdate'); 
        
    }

    public function updateinternal(Request $request, Datapasar $datapasar)
    {
        $harga = str_replace('.','',$request->harga_penawaran);
        $x = date_create($request->tanggal_data);
        $tanggal = date_format($x,"Y/m/d");

        

        if(is_numeric($request->villages1) == false){
            $villages1 = ($request->villages1);
        } else  $villages1 = Villages::where('id',$request->villages1)->first()->nama;

        if(is_numeric($request->province1) == false){
            $province1 = ($request->province1);
        } else $province1 = Province::where('id',$request->province1)->first()->nama;
        
        if(is_numeric($request->city1) == false){
            $city1 = ($request->city1);
        } else  $city1 = City::where('id',$request->city1)->first()->nama;
        
        if(is_numeric($request->districs1) == false){
            $districs1 = ($request->districs1);
        } else  $districs1 = Districs::where('id',$request->districs1)->first()->nama;
        
       
        $this->validate($request,[
            
            'keterangan1'=> 'required',
            'tanggal_data'=>'required',
            'peruntukan1' =>'required',
            'penjual'=>'required',
            'notelp'=>'required',
            'legalitas1'=>'required',
            'luas_tanah1' =>'required',
            'bentuk_tanah1' =>'required',
            'posisi1' =>'required',
            'frontage1'=>'required',
            'lebar_jalan1'=>'required',
            'koordinat1'=>'required',
            'alamat1'=>'required',
            'jarak_aktiva' => 'required',
            'harga_penawaran' =>'required',
            'gambar' => 'file|image'

        ]);
        // $gambar = null;

        // if ($request->hasFile('gambar')){
        //     $gambar = $request->file('gambar')->store('/assets/gambar');
        // };

        $nama_gambar = $datapasar->gambar;
    
            // isi dengan nama folder tempat kemana file diupload
      

        if ($request->file('gambar')){
            Storage::delete($nama_gambar);
           
            $file = $request->file('gambar');
            $nama_gambar = time()."-".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/data_gambar';
            $file->move($tujuan_upload,$nama_gambar);
        }

        // $file = $request->file('gambar');
        
        // $nama_gambar = time()."-".$file->getClientOriginalName();
    
        //     // isi dengan nama folder tempat kemana file diupload
        // $tujuan_upload = 'assets/data_gambar';
        // $file->move($tujuan_upload,$nama_gambar);
       
        $datapasar->update([
            
            'tanggal_data'=>$tanggal,
            'peruntukan1' =>$request->peruntukan1,
            'penjual'=>$request->penjual,
            'notelp'=>$request->notelp,
            'legalitas1'=>$request->legalitas1,
            'luas_tanah1' =>$request->luas_tanah1,
            'luas_bangunan1' =>$request->luas_bangunan1,
            'bentuk_tanah1' =>$request->bentuk_tanah1,
            'posisi1' =>$request->posisi1,
            'frontage1'=>$request->frontage1,
            'lebar_jalan1'=>$request->lebar_jalan1,
            'koordinat1'=>$request->koordinat1,
            'alamat1'=>$request->alamat1,
            'villages1'=>$villages1,
            'districs1'=>$districs1,
            'city1'=>$city1,
            'province1'=>$province1,
            'harga_penawaran' =>$harga,
            'keterangan1'=>$request->keterangan1,
            'gambar' => $nama_gambar,
            'jarak_aktiva' => $request->jarak_aktiva
        ]);
        
        return redirect()->route('datapasar.showinternal')->with('toast','data sudah terupdate'); 
        
    }


    public function destroy(Datapasar $datapasar)
    {
        $datapasar->delete();

        return redirect()->route('datapasar.show')->with('toast','Data sudah terhapus'); 
    }

    public function destroyinternal(Datapasar $datapasar)
    {
        $datapasar->delete();

        return redirect()->route('datapasar.showinternal')->with('toast','Data sudah terhapus'); 
    }
}

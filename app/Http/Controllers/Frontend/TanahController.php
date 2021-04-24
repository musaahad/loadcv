<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Internal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Reviews;
use App\Kerjareview;
use App\Tanah;
use InternalIterator;

class TanahController extends Controller
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
            Tanah::create([
                'kerjareview_id' =>$kerjareviews->id,
            ]);

            return redirect()->route('tanah.show')->with('toast','Data sudah ditambah, silahkan lengkapi/edit');
       }

        Tanah::create([
                'kerjainternal_id' =>$kerjainternals->id,
            ]);
            
       return redirect()->route('tanah.showinternal')->with('toast','Data sudah ditambah, silahkan lengkapi/edit');
        
    }

    public function show()
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $tanahs = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('tanah','kerjareview.id','=','tanah.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
       
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return view('frontend.tanah.show',[
            'title' => 'Legalitas Tanah',
            //'reviews'=> $reviews,
            'tanahs' => $tanahs,
            'kerjareviews' => $kerjareviews,
        ]);
        
    }

    public function showinternal()
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $tanahs = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->join('tanah','kerjainternal.id','=','tanah.kerjainternal_id')
                            ->where('status','!=','done')
                            ->get();
       
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return view('frontend.tanah_internal.show',[
            'title' => 'Legalitas Tanah',
            //'reviews'=> $reviews,
            'tanahs' => $tanahs,
            'kerjainternals' => $kerjainternals,
        ]);
        
    }

    public function edit( Tanah $tanah)
    {
        
        return view('frontend.tanah.create', [
            'title' => 'Edit Legalitas Tanah',
            'tanah'=> $tanah,
       
        ]);
    }

    public function editinternal( Tanah $tanah)
    {
        
        return view('frontend.tanah_internal.create', [
            'title' => 'Edit Legalitas Tanah',
            'tanah'=> $tanah,
       
        ]);
    }

    public function data()
    {
        $pengguna = Auth::user()->id;
    
        $tanahs = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->join('tanah','kerjareview.id','=','tanah.kerjareview_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($tanahs)
                            ->addColumn('npt1',function(Reviews $model){
                                $npt1 = $model->npt1;
                                if ($npt1 != null){
                                    return number_format($npt1);
                                };
                                    return ($npt1 =0);
                                })
                            ->addColumn('nlt1',function(Reviews $model){
                                $nlt1 = $model->nlt1;
                                if ($nlt1 != null){
                                    return number_format($nlt1);
                                };
                                    return ($nlt1 =0);
                                })
                            ->addColumn('tanggal_terbit',function(Reviews $model){
                                if ($model->tanggal_terbit == null){
                                    return null;
                                }
                                return date('d M Y',strtotime($model->tanggal_terbit));
                            }) 
                            ->addColumn('tanggal_berakhir',function(Reviews $model){
                                if ($model->tanggal_berakhir == null){
                                    return null;
                                }
                                return date('d M Y',strtotime($model->tanggal_berakhir));
                            }) 
                            ->addColumn('action','frontend.tanah.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function datainternal()
    {
        $pengguna = Auth::user()->id;
    
        $tanahs = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->join('tanah','kerjainternal.id','=','tanah.kerjainternal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($tanahs)
                            ->addColumn('npt1',function(Internal $model){
                                $npt1 = $model->npt1;
                                if ($npt1 != null){
                                    return number_format($npt1);
                                };
                                    return ($npt1 =0);
                                })
                            ->addColumn('nlt1',function(Internal $model){
                                $nlt1 = $model->nlt1;
                                if ($nlt1 != null){
                                    return number_format($nlt1);
                                };
                                    return ($nlt1 =0);
                                })
                            ->addColumn('tanggal_terbit',function(Internal $model){
                                if ($model->tanggal_terbit == null){
                                    return null;
                                }
                                return date('d M Y',strtotime($model->tanggal_terbit));
                            }) 
                            ->addColumn('tanggal_berakhir',function(Internal $model){
                                if ($model->tanggal_berakhir == null){
                                    return null;
                                }
                                return date('d M Y',strtotime($model->tanggal_berakhir));
                            }) 
                            ->addColumn('action','frontend.tanah_internal.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function update(Request $request, Tanah $tanah)
    {
        
        $x = date_create($request->tanggal_terbit);
        if(($request->tanggal_berakhir)== null) {
            $y = null;
            $tanggal_berakhir = null;
        } 
        else {
            $y = date_create($request->tanggal_berakhir);
            $tanggal_berakhir = date_format($y,"Y/m/d");
        }
        $z = date_create($request->tgl_gs);
        if(($request->npt1) == null){
            $npt1 = 0;
        }  
        if(($request->nlt1) == null){
            $nlt1 = 0;
        }       
        else {
        $npt1 = str_replace('.','',$request->npt1);
        $nlt1 = str_replace('.','',$request->nlt1);
        }
        
       
        $tanggal_terbit = date_format($x,"Y/m/d");
      
        $tgl_gs = date_format($z,"Y/m/d");
      
        $this->validate($request,[
            
            'tanggal_terbit'=> 'required',
            'jenis' =>'required',
            'no_sertifikat'=>'required',
            'luas_tanah2'=>'required',
            'no_gs'=>'required',
            'tgl_gs' => 'required',
            'atas_nama1' =>'required',
            'catatan' =>'required',
            

        ]);
        $tanah->update([
            
            'tanggal_terbit'=>$tanggal_terbit,
            'tanggal_berakhir'=>$tanggal_berakhir,
            'jenis' =>$request->jenis,
            'no_sertifikat'=>$request->no_sertifikat,
            'luas_tanah2'=>$request->luas_tanah2,
            'no_gs'=>$request->no_gs,
            'tgl_gs'=>$tgl_gs,
            'atas_nama1'=>$request->atas_nama1,
            'catatan'=>$request->catatan,
            'npt1' =>$npt1,
            'nlt1' =>$nlt1,
        ]);
        
        return redirect()->route('tanah.show')->with('toast','data sudah terupdate'); 
        
    }

    public function updateinternal(Request $request, Tanah $tanah)
    {
        
        $x = date_create($request->tanggal_terbit);
        if(($request->tanggal_berakhir)== null) {
            $y = null;
            $tanggal_berakhir = null;
        } 
        else {
            $y = date_create($request->tanggal_berakhir);
            $tanggal_berakhir = date_format($y,"Y/m/d");
        }
        $z = date_create($request->tgl_gs);
        if(($request->npt1) == null){
            $npt1 = 0;
        }  
        if(($request->nlt1) == null){
            $nlt1 = 0;
        }       
        else {
        $npt1 = str_replace('.','',$request->npt1);
        $nlt1 = str_replace('.','',$request->nlt1);
        }
        
       
        $tanggal_terbit = date_format($x,"Y/m/d");
      
        $tgl_gs = date_format($z,"Y/m/d");
      
        $this->validate($request,[
            
            'tanggal_terbit'=> 'required',
            'jenis' =>'required',
            'no_sertifikat'=>'required',
            'luas_tanah2'=>'required',
            'no_gs'=>'required',
            'tgl_gs' => 'required',
            'atas_nama1' =>'required',
            'catatan' =>'required',
            

        ]);
        $tanah->update([
            
            'tanggal_terbit'=>$tanggal_terbit,
            'tanggal_berakhir'=>$tanggal_berakhir,
            'jenis' =>$request->jenis,
            'no_sertifikat'=>$request->no_sertifikat,
            'luas_tanah2'=>$request->luas_tanah2,
            'no_gs'=>$request->no_gs,
            'tgl_gs'=>$tgl_gs,
            'atas_nama1'=>$request->atas_nama1,
            'catatan'=>$request->catatan,
            'npt1' =>$npt1,
            'nlt1' =>$nlt1,
        ]);
        
        return redirect()->route('tanah.showinternal')->with('toast','data sudah terupdate'); 
        
    }
    public function destroy(Tanah $tanah)
    {
        $tanah->delete();
       
        return redirect()->route('tanah.show')->with('toast','Data sudah terhapus'); 
    }

    public function destroyinternal(Tanah $tanah)
    {
        
        $tanah->delete();
        
        return redirect()->route('tanah.showinternal')->with('toast','Data sudah terhapus'); 
    }
}

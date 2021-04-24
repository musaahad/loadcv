<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Internal;
use App\Vercall;
use App\Flpps;
use App\Reviews;
use App\Kjpp;
use App\Bus;
use App\Kerjareview;
use App\Datapasar;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Province;
use App\City;
use App\Districs;
use App\Villages;
use Illuminate\Support\Facades\Storage;

class KerjareviewController extends Controller
{
    public function index()
    {
       $pengguna = Auth::user()->id;
       $reviews = Reviews::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);
       //$internals = Internal::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);
       //$flpps = Flpps::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);
       //$vercalls = Vercall::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);
        
        
        return view('frontend.kerjareview.index',[
            'title' => "Beranda Review LPA",
            'reviews' => $reviews,
               
            ]
        );

        //$pengguna = Auth::user()->id;
        //$reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->get();
        //$kerjarvs = $reviews->first()->id;
        //$kerjareviews = Kerjareview::where('reviews_id',$kerjarvs)->get();
        
       // return view('frontend.kerjareview.index',[
        //    'title' => Auth::user()->name,
        //    'reviews'=>$reviews,
        //    'kerjarv'=>$kerjareviews,
            
       // ]);
    }
    
    

    public function create(Request $request)
    {
        //$user = auth()->user();
         //dd($review->kjpp_id);
        //HistoryReview::create([
        //    'user_id' => auth()->id(),
        //    'load_id' => $load->id,
        //    'nomor_surat'=> $request->nomor_surat,
        //]);
        $pengguna = Auth::user()->id;
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                        ->where('users_id',$pengguna)
                        ->where('status','!=','done')->first();  
        //user harus menyelesaikan satu nama debitur sampai selesai baru mengerjakan debitur yg lain
        if ($kerjareviews != null) {
        $namadebt = $kerjareviews->nama_debitur;
        $nama_debitur = $request->nama_debitur;
        if ($nama_debitur != $namadebt ){
            return redirect()->back()
            ->with('toast','oopss! order sebelumnya belum selesai. Pilih nama debitur yang sebelumnya... ');
        }}
        //return redirect()->back()
        $nama_debitur = $request->nama_debitur;
        $reviews = Reviews::where('tanggal_selesai',null)->where('nama_debitur',$nama_debitur)->where('users_id',$pengguna)->first();
        
        $jumlah_objek =$reviews->jumlah_objek;
        
        if (Kerjareview::where('reviews_id',$reviews->id)->count()>= $jumlah_objek){
            return redirect()->route('kerjareview.show')
            ->with('toast','oopss! Jumlah objek sudah sesuai dengan order, hub TL jika mau ditambah ya... ');
        } 

        Kerjareview::create([
            'reviews_id' =>$reviews->id,
        ]);
        
       // $kerjarvs = $reviews->first()->id;
      //  $kerjareviews = Kerjareview::where('reviews_id',$kerjarvs)->get();
        
        
       // return view('frontend.kerjareview.show',[
       //     'title' => $reviews->first()->nama_debitur,
       //     'kerjareviews'=> $kerjareviews,
       ///     'reviews' => $reviews,
      //  ]);
        
        return redirect()->route('kerjareview.show')->with('toast','Data objek sudah ditambah, silahkan lengkapi/edit');
        //return view('frontend.review.create', [
        //    'title' => 'Ubah/lengkapi data pending review',
        //    'reviews' => $reviews,
        //    'kerjareview'=> $kerjareview,
        //]);
        
        //return redirect()->route('frontend.review.create');
        //->with('toast','Selanjutnya pencet tombol "Lengkapi/Edit Data"...');
    }
    
    public function tambah()
    {
        //$user = auth()->user();
         //dd($review->kjpp_id);
        //HistoryReview::create([
        //    'user_id' => auth()->id(),
        //    'load_id' => $load->id,
        //    'nomor_surat'=> $request->nomor_surat,
        //]);

        $pengguna = Auth::user()->id;
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                        ->where('status','!=','done')                
                        ->where('users_id',$pengguna)->first();
       
        //return redirect()->back()
       
        $jumlah_objek =$kerjareviews->jumlah_objek;
        
        if (Kerjareview::where('reviews_id',$kerjareviews->reviews_id)->count()>= $jumlah_objek){
            return redirect()->route('kerjareview.show')->with('toast','oopss! Jumlah objek sudah sesuai dengan order, hub TL jika mau ditambah ya... ');
        } 

        Kerjareview::create([
            'reviews_id' =>$kerjareviews->reviews_id,
        ]);
        
        //$kerjarvs = $reviews->first()->id;
        //$kerjareviews = Kerjareview::where('reviews_id',$kerjarvs)->get();
        
        
       // return view('frontend.kerjareview.show',[
       //     'title' => $reviews->first()->nama_debitur,
       //     'reviews'=> $reviews,
       //     'kerjareviews' => $kerjareviews,
       // ]);
        
        return redirect()->route('kerjareview.show')->with('toast','Data objek sudah ditambah, silahkan lengkapi/edit');
        //return view('frontend.review.create', [
        //    'title' => 'Ubah/lengkapi data pending review',
        //    'reviews' => $reviews,
        //    'kerjareview'=> $kerjareview,
        //]);
        
        //return redirect()->route('frontend.review.create');
        //->with('toast','Selanjutnya pencet tombol "Lengkapi/Edit Data"...');
    }
    
    
    public function edit(Reviews $reviews, Kerjareview $kerjareview)
    {
        //dd($kerjareview->reviews->nama_debitur);
        
        //$pengguna = Auth::user()->id;
        //$reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->get();
        //$kerjarvs = $reviews->first()->id;
        //$kerjareviews = Kerjareview::where('reviews_id',$kerjarvs)->get();
        //$provinces = Province::pluck('name', 'id');
        //$cities = City::where('province_id', $request->get('id'))->pluck('name', 'id');
       
        

       return view('frontend.kerjareview.create', [
            'title' => 'Edit Data Pending Review',
            'kerjareview'=> $kerjareview,
            'provinces' => Province::pluck('nama','id'),
            'cities' => City::pluck('nama','id'),
         //   'provinces' => $provinces,
          //  'cities'=> $cities,
        ]);

        //return response()->json($kerjareview);
    }

    public function detail(Kerjareview $kerjareview)
    {       
        
        
       return view('frontend.kerjareview.detail', [
            'title' => 'Detail Review',
            'kerjareview'=> $kerjareview,
        ]);

    }
    
    public function city(Request $request)
    {   
        $cities = City::where('province_id',$request->get('id'))->pluck('nama','id');
        return response()->json($cities);
        
    }
    public function districs(Request $request)
    {
        $districs = Districs::where('city_id',$request->get('id'))->pluck('nama','id');
        return response()->json($districs);
    }

    public function villages(Request $request)
    {
        $villages = Villages::where('districs_id',$request->get('id'))->pluck('nama','id');
        return response()->json($villages);
    }

    public function data()
    {
        $pengguna = Auth::user()->id;
    
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($kerjareviews)
                           ->addColumn('NP Total',function(Reviews $model){
                                $npt = $model->npt;
                                return number_format($npt);
                            })
                            ->addColumn('NL Total',function(Reviews $model){
                                $nlt = $model->nlt;
                                return number_format($nlt);
                            })
                            ->addColumn('Np/m2',function(Reviews $model){
                                $np_permeter = $model->np_permeter;
                                return number_format($np_permeter);
                            })
                          
                            ->addColumn('action','frontend.kerjareview.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    
    
    public function dataall()
    {
    
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->get();

        return datatables()->of($kerjareviews)
                           ->addColumn('NP Total',function(Reviews $model){
                                $npt = $model->npt;
                                return number_format($npt);
                            })
                            ->addColumn('PIC',function(Reviews $model){
                                
                                return $model->users->name;
                            })
                            ->addColumn('Np/m2',function(Reviews $model){
                                $np_permeter = $model->np_permeter;
                                return number_format($np_permeter);
                            })
                            ->addColumn('tanggal_lengkap',function(Reviews $model){
                               
                                return date('d M Y',strtotime($model->tanggal_lengkap));
                            }) 
                            ->addIndexColumn()
                            ->toJson();
    }
    
    public function update(Request $request,  Reviews $review, Kerjareview $kerjareview)
    {
       
        
        $npt = str_replace('.','',$request->npt);
        $nlt = str_replace('.','',$request->nlt);
        $np_permeter = str_replace('.','',$request->np_permeter);      
        
        $x = date_create($request->tanggal_lengkap);
        $tanggal_lengkap = date_format($x,"Y/m/d");
        
        $y = date_create($request->tanggal_inspeksi);
        $tanggal_inspeksi = date_format($y,"Y/m/d");

        $z = date_create($request->tanggal_penilaian);
        $tanggal_penilaian = date_format($z,"Y/m/d");

        
        if(is_numeric($request->province) == false){
            $province = ($request->province);
        } else $province = Province::where('id',$request->province)->first()->nama;
        
        if(is_numeric($request->city) == false){
            $city = ($request->city);
        } else  $city = City::where('id',$request->city)->first()->nama;
        
        if(is_numeric($request->districs) == false){
            $districs = ($request->districs);
        } else  $districs = Districs::where('id',$request->districs)->first()->nama;
       
        if(is_numeric($request->villages) == false){
            $villages = ($request->villages);
        } else  $villages = Villages::where('id',$request->villages)->first()->nama;
        

        function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     
            return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
        }

        $this->validate($request,[  
            'keterangan'=> 'required',
            'tanggal_lengkap'=>'required',
            'tanggal_inspeksi'=>'required',
            'tanggal_penilaian'=>'required',
            'peruntukan' =>'required',
            'pendekatan'=>'required',
            'bentuk_tanah' =>'required',
            'posisi' =>'required',
            'frontage'=>'required',
            'lebar_jalan'=>'required',
            'koordinat'=>'required',
            'alamat'=>'required',
            'villages'=>'required',
            'districs'=>'required',
            'city'=>'required',
            'province'=>'required',
            'npt' =>'required',
            'nlt' =>'required',
            'np_permeter' => 'required',
            'gambar_review' => 'file|image'
        ]);

        $nama_gambar = $kerjareview->gambar_review;
        
        if ($request->file('gambar_review')){
            Storage::delete($nama_gambar);
           
            $file = $request->file('gambar_review');
            $nama_gambar = time()."-".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/gambar_review';
            $file->move($tujuan_upload,$nama_gambar);
        }

        $alamatclear = clean($request->alamat);
        
        $kerjareview->update([
            
            'tanggal_lengkap'=>$tanggal_lengkap,
            'tanggal_inspeksi'=>$tanggal_inspeksi,
            'tanggal_penilaian'=>$tanggal_penilaian,
            'peruntukan' =>$request->peruntukan,
            'pendekatan'=>$request->pendekatan,
            'bentuk_tanah' =>$request->bentuk_tanah,
            'posisi' =>$request->posisi,
            'frontage'=>$request->frontage,
            'lebar_jalan'=>$request->lebar_jalan,
            'koordinat'=>$request->koordinat,
            'alamat'=>$alamatclear,
            'villages'=>$villages,
            'districs'=>$districs,
            'city'=>$city,
            'province'=>$province,
            'npt' =>$npt,
            'nlt' =>$nlt,
            'lt_total' =>$request->lt_total,
            'lb_total' =>$request->lb_total,
            'np_permeter' =>$np_permeter,
            'keterangan'=>$request->keterangan,
            'gambar_review' => $nama_gambar,
        ]);

        return redirect()->route('kerjareview.show')->with('toast','data sudah terupdate'); 

        
    }

    public function show(Kerjareview $kerjareview)
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();
        $provinces = Province::pluck('nama', 'id');
       
        return view('frontend.kerjareview.show',[
            'title' => 'Daftar Objek',
            //'reviews'=> $reviews,
            'kerjareviews' => $kerjareviews,
            'provinces' =>$provinces,
        ]);
        
    }


    public function datanilai()
    {
        return view('frontend.kerjareview.database',[
            'title' => 'Database Nilai',
        ]);
    }

    public function database()
    {
    
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->get();

        return datatables()->of($kerjareviews)
                            ->addColumn('action','frontend.kerjareview.action2')
                            ->addColumn('NP Total',function(Reviews $model){
                                $npt = $model->npt;
                                return number_format($npt);
                            })
                            ->addColumn('PIC',function(Reviews $model){
                                
                                return $model->users->name;
                            })
                            ->addColumn('Np/m2',function(Reviews $model){
                                $np_permeter = $model->np_permeter;
                                return number_format($np_permeter);
                            })
                            ->addColumn('tanggal_penilaian',function(Reviews $model){
                               
                                return date('d M Y',strtotime($model->tanggal_penilaian));
                            }) 
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function laporan()
    {
        $pengguna = Auth::user()->id;
        //ini table review + kerjareview + datapasar
        $datapasars = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('datapasar','kerjareview.id','=','datapasar.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
        //ini table review + kerjareview + tanah
        $tanahs = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->join('tanah','kerjareview.id','=','tanah.kerjareview_id')
                            ->get();
       
        //ini table review + kerjareview + bangunan
        $bangunans = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('bangunan','kerjareview.id','=','bangunan.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();

        
        //ini table review + kerjareview + mesinspl
        $mesinspls = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('mesinspl','kerjareview.id','=','mesinspl.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
        //ini table review + kerjareview
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        //ini table review saja
        $reviews = $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->get();

        $data = $datapasars->count();
        $jml_objek = $reviews->first()->jumlah_objek;
        $jml_objek1 = $kerjareviews->count();
        $jml_data = $jml_objek * 3;
       
       // if ($jml_objek1 != $jml_objek){
       //     return redirect()->route('kerjareview.show')->with('toast','oopss! Jumlah objek belum sesuai dengan order, hub TL jika mau dikurangi ya... ');
       // } 

        //if ($data != $jml_data){
        //     return redirect()->route('kerjareview.show')->with('toast','oopss! Jumlah data pembanding belum sesuai dengan jumlah objek (3 data @objek), mohon lengkapi dulu ya...');
        // } 

        require 'C:\Users\Mujahidin\vendor\autoload.php';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('Review_LPA.docx'));
        
        $tanahss = $tanahs->groupBy('kerjareview_id');
        $bangunanss = $bangunans->groupBy('kerjareview_id');
        $mesinsplss = $mesinspls->groupBy('kerjareview_id');
        
        $templateProcessor->cloneBlock('cloneme',$kerjareviews->first()->jumlah_objek, true);
        $templateProcessor->cloneBlock('clonelegalitas',$tanahs->count(), true);
        
        //ini utk tanah
        $lttotal = 0;
        $npt_total = 0;
        $nlt_total = 0;
         //ini utk bangunan
         $npb_total = 0;
         $nlb_total = 0;
         $lbtotal = 0;
         $npm_total = 0;
         $nlm_total = 0;
        foreach($kerjareviews as $kerjareview){
            $templateProcessor->setValue("nama_debitur",$kerjareview->nama_debitur,1);
            $templateProcessor->setValue("bu",$kerjareview->bus->name,1);
            $templateProcessor->setValue("alamatbu",$kerjareview->bus->alamatbu,1);
            $templateProcessor->setValue("kjpp",$kerjareview->kjpps->name,1);
            $templateProcessor->setValue("klasifikasi",$kerjareview->kjpps->klasifikasi,1);
            $templateProcessor->setValue("pic",$kerjareview->users->name,1);
            $templateProcessor->setValue("nip",$kerjareview->users->nip,1);
            $templateProcessor->setValue("jabatan",$kerjareview->users->jabatan,1);
            $templateProcessor->setValue("tanggal_terima",date('d M Y',strtotime($kerjareview->tanggal_terima)),1);
            $templateProcessor->setValue("tanggal_suratbu",date('d M Y',strtotime($kerjareview->tanggal_suratbu)),1);
            $templateProcessor->setValue("nosuratbu",$kerjareview->nosuratbu,1);
            $templateProcessor->setValue("no_lpa",$kerjareview->no_lpa,1);
            $templateProcessor->setValue("tanggal_lpa",date('d M Y',strtotime($kerjareview->tanggal_lpa)),1);
            $templateProcessor->setValue("tujuan",$kerjareview->tujuan,1);
            $templateProcessor->setValue("pimpinan",$kerjareview->kjpps->pimpinan,1);
            $templateProcessor->setValue("nomappi",$kerjareview->kjpps->nomappi,1);
            $templateProcessor->setValue("ijinpublik",$kerjareview->kjpps->ijinpublik,1);
            $templateProcessor->setValue("peruntukan",$kerjareview->peruntukan,1);
            $templateProcessor->setValue("tanggal_lengkap",date('d M Y',strtotime($kerjareview->tanggal_lengkap)),1);
            $templateProcessor->setValue("alamat",$kerjareview->alamat,1);
            $templateProcessor->setValue("villages",$kerjareview->villages,1);
            $templateProcessor->setValue("districs",$kerjareview->districs,1);
            $templateProcessor->setValue("city",$kerjareview->city,1);
            $templateProcessor->setValue("province",$kerjareview->province,1);
            $templateProcessor->setValue("koordinat",$kerjareview->koordinat,1);
            $templateProcessor->setValue("tanggal_inspeksi",date('d M Y',strtotime($kerjareview->tanggal_inspeksi)),1);
            $templateProcessor->setValue("tanggal_penilaian",date('d M Y',strtotime($kerjareview->tanggal_penilaian)),1);
            $templateProcessor->setValue("pendekatan",$kerjareview->pendekatan,1);
            $templateProcessor->setValue("luas_tanah",number_format($kerjareview->lt_total),1);
            $templateProcessor->setValue("luas_bangunan",number_format($kerjareview->lb_total),1);
       
        foreach($tanahss as $t){
            foreach ($t as $tanah){
            $lt = $tanah['luas_tanah2'];
            $npt = $tanah['npt1'];
            $nlt = $tanah['nlt1'];
            $lttotal += $lt;
            $npt_total += $npt;
            $nlt_total += $nlt;    
            
            $templateProcessor->setValue("jenis",$tanah->jenis,1);
            $templateProcessor->setValue("no_sertifikat",$tanah->no_sertifikat,1);
            $templateProcessor->setValue("atas_nama",$tanah->atas_nama1,1);
            if ($t->count() == 1){
                $templateProcessor->setValue("luas_tanah",$lt,1);
            }
        }
            if ($t->count() > 1){
                $templateProcessor->setValue("luas_tanah",$lttotal,1);
                
            }
        }   
      
        foreach($bangunanss as $b){
            foreach ($b as $bangunan){
            $npb = $bangunan['npb1'];
            $nlb = $bangunan['nlb1'];
            $npb_total += $npb;
            $nlb_total += $nlb;
            
            
            // if(($kerjareview->alamat) == ($bangunan->alamat)){
            //     $lb = $bangunan->luas_bangunan2;
            //     $lbtotal += $lb ;
                
            // }   else {
            //     $lb = null;
            //     $lbtotal = null;
            // }
             
            // if ($b->count() == 1){
            //     $templateProcessor->setValue("luas_bangunan",$lb,1);
            // } 
            //if ($b->count() == 1){
                
            }
            // if ($b->count() > 1){
            //     $templateProcessor->setValue("luas_bangunan",$lbtotal,1);
            // }
            //else  $templateProcessor->setValue("luas_bangunan",null,1);
            //if ($b->count() > 1){
            //$templateProcessor->setValue("luas_bangunan",$lbtotal,1);
            
        }
        

    
        //ini utk mesin-spl
        $npm_total = 0;
        $nlm_total = 0;
        foreach($mesinsplss as $c){
            foreach ($c as $mesinspl){
            $npm = $mesinspl['npm1'];
            $nlm = $mesinspl['nlm1'];
            $npm_total += $npm;
            $nlm_total += $nlm;
     
            }
        }
        $np_total = $npt_total + $npb_total + $npm_total ;
        $nl_total = $nlt_total + $nlb_total + $nlm_total ; 
        
      
        $templateProcessor->setValue("np_total",number_format($np_total));
        $templateProcessor->setValue("nl_total",number_format($nl_total));
        $templateProcessor->setValue("hari_ini",date('d M Y'));
    }

    
        
        header("Content-Disposition: attachment; filename=Review_LPA.docx");
        
        $templateProcessor->saveAs('php://output');
        
        return redirect()->route('kerjareview.show')->with('toast','Laporan sudah terdownload'); 
        
    }

    public function workform()
    {
        $pengguna = Auth::user()->id;
        //ini table review + kerjareview + datapasar
        $datapasars = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('datapasar','kerjareview.id','=','datapasar.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
        //ini table review + kerjareview + tanah
        $tanahs = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->join('tanah','kerjareview.id','=','tanah.kerjareview_id')
                            //->leftJoin('bangunan','kerjareview.id','=','bangunan.kerjareview_id')
                            //->leftJoin('mesinspl','kerjareview.id','=','mesinspl.kerjareview_id')
                           // ->select('jenis','alamat','nama','npt1','nlt1','no_sertifikat','no_gs',
                           // 'tgl_gs','tanggal_terbit','tanggal_berakhir','atas_nama1','luas_tanah2',
                           // 'luas_bangunan2','npb1','nlb1','nama_mesin','spesifikasi','satuan','npm1',
                          //  'nlm1','kondisi_spl','kondisi_bangunan','peruntukan','villages','districs',
                          //  'city','province','koordinat','nama_debitur','tanggal_inspeksi',
                         //  'tanggal_lengkap','tanggal_inspeksi' )
                            ->get();
        
       
        //ini table review + kerjareview + bangunan
        $bangunans = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('bangunan','kerjareview.id','=','bangunan.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
       
        //ini table review + kerjareview + mesinspl
        $mesinspls = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->join('mesinspl','kerjareview.id','=','mesinspl.kerjareview_id')
                            ->where('status','!=','done')
                            ->get();
        
        //ini table review + kerjareview
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();
        
       
        //ini table review saja
        $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->get();

        $data = $datapasars->count();
        $jml_objek = $reviews->first()->jumlah_objek;
        $jml_objek1 = $kerjareviews->count();
        $jml_data = $jml_objek * 3;
       
       // if ($jml_objek1 != $jml_objek){
       //     return redirect()->route('kerjareview.show')->with('toast','oopss! Jumlah objek belum sesuai dengan order, hub TL jika mau dikurangi ya... ');
       // } 

       // if ($data != $jml_data){
       //      return redirect()->route('kerjareview.show')->with('toast','oopss! Jumlah data pembanding belum sesuai dengan jumlah objek (3 data @objek), mohon lengkapi dulu ya...');
        // } 
        $tanahss = $tanahs->groupBy('kerjareview_id');
       
        $bangunanss = $bangunans->groupBy('kerjareview_id');
        $mesinsplss = $mesinspls->groupBy('kerjareview_id');
        
        $t = $tanahss->toArray();
       
       // $bgn = $bangunans->toArray();
       // $msn = $mesinspls->toArray();
      
       
        require 'C:\Users\Mujahidin\vendor\autoload.php';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('Review_kertas.docx'));
       
        $templateProcessor->cloneBlock('cloneme',$tanahss->count(),true);
        $templateProcessor->cloneBlock('clone2',$tanahs->count(),true);  
        $templateProcessor->cloneBlock('clone3',$bangunans->count(),true);
        $templateProcessor->cloneBlock('clone4',$mesinspls->count(),true);

        $npt_total = 0;
        $nlt_total = 0;
        $lttotal = 0;
        $npb_total = 0;
        $nlb_total = 0;
        $npm_total = 0;
        $nlm_total = 0;
        foreach($kerjareviews as $kerjareview){
            
            $nl_pers = ($kerjareview->nlt) / ($kerjareview->npt) ;
            $nl_persen = number_format($nl_pers*100).'%';               
           
            $templateProcessor->setValue("nama_debitur",$kerjareview->nama_debitur,1);
            $templateProcessor->setValue("kjpp",$kerjareview->kjpps->name,1);
            $templateProcessor->setValue("peruntukan",$kerjareview->peruntukan,1);
            $templateProcessor->setValue("luas_tanah",$kerjareview->luas_tanah,1);
            $templateProcessor->setValue("luas_bangunan",$kerjareview->luas_bangunan,1);
            $templateProcessor->setValue("alamat",$kerjareview->alamat,1);
            $templateProcessor->setValue("villages",$kerjareview->villages,1);
            $templateProcessor->setValue("districs",$kerjareview->districs,1);
            $templateProcessor->setValue("city",$kerjareview->city,1);
            $templateProcessor->setValue("province",$kerjareview->province,1);
            $templateProcessor->setValue("koordinat",$kerjareview->koordinat,1);
            $templateProcessor->setValue("tanggal_inspeksi",$kerjareview->tanggal_inspeksi,1);
            $templateProcessor->setValue("tanggal_penilaian",date('d-m-Y',strtotime($kerjareview->tanggal_penilaian)),1);
            $templateProcessor->setValue("tanggal_lengkap",date('d-m-Y',strtotime($kerjareview->tanggal_lengkap)),1);
            $templateProcessor->setValue("nl_persen",$nl_persen,1);
            $templateProcessor->setValue("npt",number_format($kerjareview->npt),1);
            $templateProcessor->setValue("nlt",number_format($kerjareview->nlt),1);

            foreach($tanahs as $tanah){
                   
                $lt = $tanah->luas_tanah2;
                $npt1 = $tanah->npt1;
                $nlt1 = $tanah->nlt1;
                $lttotal += $lt;
                $npt_total += $npt1;
                $nlt_total += $nlt1;

                if($npt1 == 0){
                    $npt_permeter1 = 0;
                }
                $npt_permeter1 = $npt1 / $lt ;
                if($npt1 == 0){
                    $nlt_pers = 0;
                }
                else $nlt_pers = $nlt1 / $npt1 ;
                $nlt_persen1 = number_format($nlt_pers*100).'%'; 
                
                if(($tanah->tanggal_berakhir) == null){
                       $tanggal_berakhir = null;
                   } else $tanggal_berakhir = date('d-m-Y',strtotime($tanah->tanggal_berakhir));

                   if (($kerjareview->alamat) == ($tanah->alamat)){
                        $templateProcessor->setValue("jenis",$tanah['jenis'],1);
                        $templateProcessor->setValue("no_sertifikat",$tanah['no_sertifikat'],1);
                        $templateProcessor->setValue("no_gs",$tanah['no_gs'],1);
                        $templateProcessor->setValue("tgl_gs",date('d-m-Y', strtotime($tanah['tgl_gs'])),1);
                        $templateProcessor->setValue("tanggal_terbit",date('d-m-Y',strtotime($tanah['tanggal_terbit'])),1);
                        $templateProcessor->setValue("tanggal_berakhir",$tanggal_berakhir,1);
                        $templateProcessor->setValue("atas_nama1",$tanah['atas_nama1'],1);
                        $templateProcessor->setValue("npt1",number_format($npt1),1);
                        $templateProcessor->setValue("nlt1",number_format($nlt1),1);
                        $templateProcessor->setValue("npt_permeter", number_format($npt_permeter1), 1);
                        $templateProcessor->setValue("nlt_persen", $nlt_persen1, 1);
                        $templateProcessor->setValue("luas_tanah2", $lt, 1);
                    
                   } else {
                        $templateProcessor->setValue("jenis",null,1);
                        $templateProcessor->setValue("no_sertifikat",null,1);
                        $templateProcessor->setValue("no_gs",null,1);
                        $templateProcessor->setValue("tgl_gs",null,1);
                        $templateProcessor->setValue("tanggal_terbit",null,1);
                        $templateProcessor->setValue("tanggal_berakhir",null,1);
                        $templateProcessor->setValue("atas_nama1",null,1);
                        $templateProcessor->setValue("npt1",null,1);
                        $templateProcessor->setValue("nlt1",null,1);
                        $templateProcessor->setValue("npt_permeter", null, 1);
                        $templateProcessor->setValue("nlt_persen", null, 1);
                        $templateProcessor->setValue("luas_tanah2", null, 1);
                        
                   }
                }  
           
            // //ini utk bangunan
            foreach($bangunans as $bangunan){

                $npb1 = $bangunan->npb1;
                $nlb1 = $bangunan->nlb1;
                $npb_total += $npb1;
                $nlb_total += $nlb1;

                $luas = $bangunan->luas_bangunan2;
                $npb_permeter = $npb1 / $luas ;
                $nlb_pers = $nlb1 / $npb1 ;
                $nlb_persen = number_format($nlb_pers*100).'%';         
                    
                if (($kerjareview->alamat) == ($bangunan->alamat)){
                    $templateProcessor->setValue("luas_bangunan2",number_format($bangunan->luas_bangunan2),1);
                    $templateProcessor->setValue("npb",number_format($npb1),1);
                    $templateProcessor->setValue("nlb",number_format($nlb1),1);
                    $templateProcessor->setValue("npb_permeter", number_format($npb_permeter), 1);
                    $templateProcessor->setValue("nlb_persen", $nlb_persen, 1);
                    $templateProcessor->setValue("nama", $bangunan->nama, 1);
                    $templateProcessor->setValue("kondisi_bangunan",$bangunan->kondisi_bangunan, 1);
                } else {
                    $templateProcessor->setValue("luas_bangunan2",null,1);
                    $templateProcessor->setValue("npb",null,1);
                    $templateProcessor->setValue("nlb",null,1);
                    $templateProcessor->setValue("npb_permeter", null, 1);
                    $templateProcessor->setValue("nlb_persen", null, 1);
                    $templateProcessor->setValue("nama",null, 1);
                    $templateProcessor->setValue("kondisi_bangunan",null, 1);
                }
             }  
             //ini utk mesin-spl
             foreach($mesinspls as $mesinspl){

                $npm = $mesinspl->npm1;
                $nlm = $mesinspl->nlm1;
                $npm_total += $npm;
                $nlm_total += $nlm;
    
                $nlm_pers = $nlm / $npm ;
                $nlm_persen = number_format($nlm_pers*100).'%';         
       
                if (($kerjareview->alamat) == ($mesinspl->alamat)){
                    $templateProcessor->setValue("spesifikasi",$mesinspl->spesifikasi,1);
                    $templateProcessor->setValue("satuan", $mesinspl->satuan, 1);
                    $templateProcessor->setValue("nama_mesin", $mesinspl->nama_mesin, 1);
                    $templateProcessor->setValue("kondisi_spl",$mesinspl->kondisi_spl, 1);
                    $templateProcessor->setValue("npm",number_format($npm),1);
                    $templateProcessor->setValue("nlm",number_format($nlm),1);
                    $templateProcessor->setValue("nlm_persen", $nlm_persen, 1);
                } else {
                    $templateProcessor->setValue("spesifikasi",null,1);
                    $templateProcessor->setValue("satuan", null, 1);
                    $templateProcessor->setValue("nama_mesin", null, 1);
                    $templateProcessor->setValue("kondisi_spl",null, 1);
                    $templateProcessor->setValue("npm",null,1);
                    $templateProcessor->setValue("nlm",null,1);
                    $templateProcessor->setValue("nlm_persen", null, 1);
                }
             }  
           
             $np_total = $npt_total + $npb_total + $npm_total ;
             $nl_total = $nlt_total + $nlb_total + $nlm_total ;
            
             $nl_pers = $nl_total / $np_total ;
             $nl_persen = number_format($nl_pers*100).'%';   
             
             $templateProcessor->setValue("hari_ini",date('d-m-Y'));
             $templateProcessor->setValue("np_total",number_format($np_total));
             $templateProcessor->setValue("nl_total",number_format($nl_total));
             $templateProcessor->setValue("nl_persen",$nl_persen);     
      } 
        
        header("Content-Disposition: attachment; filename=Review_Kertaskerja.docx");
        
        $templateProcessor->saveAs('php://output');
        
        return redirect()->route('kerjareview.show')->with('toast','Kertas Kerja sudah terdownload'); 
        
    }

    public function checklist()
    {
        $pengguna = Auth::user()->id;
        //ini table review + kerjareview + tanah
        $tanahs = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->join('tanah','kerjareview.id','=','tanah.kerjareview_id')
                            ->get();
        //ini table review + kerjareview
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();
       
        if ($tanahs == null) {
            return redirect()->route('kerjareview.show')->with('toast','oopss! Lengkapi dulu data tanah ya... ');
        } 
        
        $tanahss = $tanahs->groupBy('kerjareview_id');
      
        require 'C:\Users\Mujahidin\vendor\autoload.php';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('checklist_review.docx'));

        $templateProcessor->cloneBlock('cloneme',$kerjareviews->first()->jumlah_objek, true);
        $templateProcessor->cloneBlock('clone2',$tanahss->count(), true);
    
    
        foreach($kerjareviews as $kerjareview){          
            $templateProcessor->setValue("nama_debitur",$kerjareview->nama_debitur,1);
            $templateProcessor->setValue("pic",$kerjareview->users->name,1);
            $templateProcessor->setValue("jabatan",$kerjareview->users->jabatan,1);
            $templateProcessor->setValue("kjpp",$kerjareview->kjpps->name,1);
            $templateProcessor->setValue("alamat",$kerjareview->alamat,1);
            $templateProcessor->setValue("villages",$kerjareview->villages,1);
            $templateProcessor->setValue("districs",$kerjareview->districs,1);
            $templateProcessor->setValue("city",$kerjareview->city,1);
            $templateProcessor->setValue("province",$kerjareview->province,1);
            $templateProcessor->setValue("koordinat",$kerjareview->koordinat,1);
        }
        //ini utk tanah
        foreach($tanahss as $t){
            foreach ($t as $tanah){     
            $templateProcessor->setValue("no_sertifikat",$tanah->no_sertifikat,1);
            $templateProcessor->setValue("atas_nama",$tanah->atas_nama1,1);
            }
        }
        
        $templateProcessor->setValue("hari_ini",date('d M Y'));

        header("Content-Disposition: attachment; filename=checklist_review.docx");
        
        $templateProcessor->saveAs('php://output');
        
        return redirect()->route('kerjareview.show')->with('toast','Checklist review sudah terdownload'); 
        
    }
    
    public function destroy(Kerjareview $kerjareview)
    {
        $kerjareview->delete();

        return redirect()->route('kerjareview.show')->with('toast','Data sudah terhapus'); 
    }

    
}

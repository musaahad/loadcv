<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Internal;
use Illuminate\Http\Request;
use App\Kerjainternal;
use Illuminate\Support\Facades\Auth;
use App\Province;
use App\City;
use App\Districs;
use App\Villages;
use App\User;
use Illuminate\Support\Facades\Storage;

class KerjainternalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = Auth::user()->id;
        $internals = Internal::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);       
        
        return view('frontend.kerjainternal.index',[
            'title' => "Beranda Penilaian Internal",
            'internals' => $internals,
               
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pengguna = Auth::user()->id;
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                        ->where('users_id',$pengguna)
                        ->where('status','!=','done')->first();  
        //user harus menyelesaikan satu nama debitur sampai selesai baru mengerjakan debitur yg lain
        if ($kerjainternals != null) {
        $namadebt = $kerjainternals->nama_debitur;
        $nama_debitur = $request->nama_debitur;
        if ($nama_debitur != $namadebt ){
            return redirect()->back()
            ->with('toast','oopss! order sebelumnya belum selesai. Pilih nama debitur yang sebelumnya... ');
        }}

        $nama_debitur = $request->nama_debitur;
        $internals = Internal::where('tanggal_selesai',null)->where('nama_debitur',$nama_debitur)->where('users_id',$pengguna)->first();
        
        $jumlah_objek =$internals->jumlah_objek;
        
        if (Kerjainternal::where('internal_id',$internals->id)->count()>= $jumlah_objek){
            return redirect()->route('kerjainternal.show')
            ->with('toast','oopss! Jumlah objek sudah sesuai dengan order, hub TL jika mau ditambah ya... ');
        } 

        Kerjainternal::create([
            'internal_id' =>$internals->id,
        ]);
        
        return redirect()->route('kerjainternal.show')->with('toast','Data objek sudah ditambah, silahkan lengkapi/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        $pengguna = Auth::user()->id;
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                        ->where('users_id',$pengguna)
                        ->where('status','!=','done')->first(); 
       
        //return redirect()->back()
       
        $jumlah_objek =$kerjainternals->jumlah_objek;
        
        if (Kerjainternal::where('internal_id',$kerjainternals->id)->count()>= $jumlah_objek){
            return redirect()->route('kerjainternal.show')
            ->with('toast','oopss! Jumlah objek sudah sesuai dengan order, hub TL jika mau ditambah ya... ');
        } 

        Kerjainternal::create([
            'internal_id' =>$kerjainternals->id,
        ]);
        
        return redirect()->route('kerjainternal.show')->with('toast','Data objek sudah ditambah, silahkan lengkapi/edit');
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kerjainternal $kerjainternal)
    {
        return view('frontend.kerjainternal.create', [
            'title' => 'Edit Data Pending Review',
            'kerjainternal'=> $kerjainternal,
            'provinces' => Province::pluck('nama','id'),
            'cities' => City::pluck('nama','id'),
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kerjainternal $kerjainternal)
    {
        $nilai_pasar = str_replace('.','',$request->nilai_pasar);
        $nilai_likuidasi = str_replace('.','',$request->nilai_likuidasi);
        $nilai_sm = str_replace('.','',$request->nilai_sm);
        $np_permeter = str_replace('.','',$request->np_permeter);      
        
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
     
            return preg_replace('/-+/', '', $string); // Replaces multiple hyphens with single one.
         }

        $this->validate($request,[  
            'keterangan'=> 'required',
            
            'tanggal_penilaian'=>'required',
            'peruntukan' =>'required',
            'pendekatan'=>'required',
            'kawasan' => 'required',
            'bentuk_tanah' =>'required',
            'posisi' =>'required',
            'frontage'=>'required',
            'elevasi' => 'required',
            'lebar_jalan'=>'required',
            'luas_tanah' => 'required',
            'koordinat'=>'required',
            'alamat'=>'required',
            'villages'=>'required',
            'districs'=>'required',
            'city'=>'required',
            'province'=>'required',
            'nilai_pasar' =>'required',
            'nilai_sm' => 'required',
            'nilai_likuidasi' =>'required',
            'np_permeter' => 'required',
            'gambar_depan' => 'file|image'
        ]);
       
        $nama_gambar = $kerjainternal->gambar_depan;
        
        if ($request->file('gambar_depan')){
            Storage::delete($nama_gambar);
           
            $file = $request->file('gambar_depan');
            $nama_gambar = time()."-".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/gambar_internal';
            $file->move($tujuan_upload,$nama_gambar);
        }
        
        
       
        
        $alamatclear = clean($request->alamat);

        $kerjainternal->update([
            
            
            'tanggal_penilaian'=>$tanggal_penilaian,
            'pendamping' =>$request->pendamping,
            'peruntukan' =>$request->peruntukan,
            'pendekatan'=>$request->pendekatan,
            'kawasan' => $request->kawasan,
            'bentuk_tanah' =>$request->bentuk_tanah,
            'posisi' =>$request->posisi,
            'frontage'=>$request->frontage,
            'elevasi' =>$request->elevasi,
            'jumlah_lantai' => $request->jumlah_lantai,
            'lebar_jalan'=>$request->lebar_jalan,
            'koordinat'=>$request->koordinat,
            'alamat'=>$alamatclear,
            'villages'=>$villages,
            'districs'=>$districs,
            'city'=>$city,
            'province'=>$province,
            'nilai_pasar' =>$nilai_pasar,
            'nilai_likuidasi' =>$nilai_likuidasi,
            'nilai_sm' => $nilai_sm,
            'luas_tanah' =>$request->luas_tanah,
            'luas_bangunan' =>$request->luas_bangunan,
            'np_permeter' =>$np_permeter,
            'keterangan'=>$request->keterangan,
            'gambar_depan' => $nama_gambar,
        ]);

        return redirect()->route('kerjainternal.show')->with('toast','data sudah terupdate'); 
    }

    public function detail(Kerjainternal $kerjainternal)
    {       
        
        
       return view('frontend.kerjainternal.detail', [
            'title' => 'Detail Internal',
            'kerjainternal'=> $kerjainternal,
        ]);

    }
    
    public function datanilai()
    {
        return view('frontend.kerjainternal.database',[
            'title' => 'Database Nilai',
        ]);
    }

    public function database()
    {
    
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->get();

        return datatables()->of($kerjainternals)
                            ->addColumn('action','frontend.kerjainternal.action2')
                            ->addColumn('NP Total',function(Internal $model){
                                $npt = $model->nilai_pasar;
                                return number_format($npt);
                            })
                            ->addColumn('PIC',function(Internal $model){
                                
                                return $model->users->name;
                            })
                            ->addColumn('Np/m2',function(Internal $model){
                                $np_permeter = $model->np_permeter;
                                return number_format($np_permeter);
                            })
                            ->addColumn('tanggal_penilaian',function(Internal $model){
                               
                                return date('d M Y',strtotime($model->tanggal_penilaian));
                            }) 
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function data()
    {
        $pengguna = Auth::user()->id;
    
        $internals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($internals)
                           ->addColumn('NP Total',function(Internal $model){
                                $npt = $model->nilai_pasar;
                                return number_format($npt);
                            })
                            ->addColumn('NL Total',function(Internal $model){
                                $nlt = $model->nilai_likuidasi;
                                return number_format($nlt);
                            })
                            ->addColumn('Np/m2',function(Internal $model){
                                $np_permeter = $model->np_permeter;
                                return number_format($np_permeter);
                            })
                          
                            ->addColumn('action','frontend.kerjainternal.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }
    
    public function show(Kerjainternal $kerjainternal)
    {
        
 
       $pengguna = Auth::user()->id;
       // $reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->first();
        
        //$kerjarvs = $reviews->id;
    
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();
        $provinces = Province::pluck('nama', 'id');
       
        return view('frontend.kerjainternal.show',[
            'title' => 'Daftar Objek',
            //'reviews'=> $reviews,
            'kerjainternals' => $kerjainternals,
            'provinces' =>$provinces,
        ]);
        
    }

    public function laporan()
    {
        $pengguna = Auth::user()->id;
        
        $datapasars = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->join('datapasar','kerjainternal.id','=','datapasar.kerjainternal_id')
                            ->where('status','!=','done')
                            ->get();
        
        $tanahs = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->join('tanah','kerjainternal.id','=','tanah.kerjainternal_id')
                            ->get();
       
        
        $bangunans = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->join('bangunan','kerjainternal.id','=','bangunan.kerjainternal_id')
                            ->where('status','!=','done')
                            ->get();
       
        
        
        $mesinspls = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->join('mesinspl','kerjainternal.id','=','mesinspl.kerjainternal_id')
                            ->where('status','!=','done')
                            ->get();
        
        $kerjainternals = Internal::join('kerjainternal','internal.id','=','kerjainternal.internal_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

      
        $internals = Internal::where('tanggal_selesai',null)->where('users_id',$pengguna)->get();

        $data = $datapasars->count();
        $jml_objek = $internals->first()->jumlah_objek;
        $jml_objek1 = $kerjainternals->count();
        $jml_data = $jml_objek * 3;
       
       // if ($jml_objek1 != $jml_objek){
       //     return redirect()->route('kerjareview.show')->with('toast','oopss! Jumlah objek belum sesuai dengan order, hub TL jika mau dikurangi ya... ');
       // } 

        //if ($data != $jml_data){
        //     return redirect()->route('kerjareview.show')->with('toast','oopss! Jumlah data pembanding belum sesuai dengan jumlah objek (3 data @objek), mohon lengkapi dulu ya...');
        // } 

        require 'C:\Users\Mujahidin\vendor\autoload.php';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('template_internal.docx'));
        
        $tanahss = $tanahs->groupBy('kerjainternal_id');
        $bangunanss = $bangunans->groupBy('kerjainternal_id');
        $mesinsplss = $mesinspls->groupBy('kerjainternal_id');
        
        $templateProcessor->cloneBlock('clone1',$kerjainternals->first()->jumlah_objek, true);
        $templateProcessor->cloneBlock('clone2',$kerjainternals->first()->jumlah_objek, true);
        $templateProcessor->cloneBlock('clone3',$kerjainternals->first()->jumlah_objek, true);
        $templateProcessor->cloneBlock('clone4',$kerjainternals->first()->jumlah_objek, true);
        $templateProcessor->cloneBlock('clone5',$tanahs->count(),true); 
        $templateProcessor->cloneBlock('clone6',$kerjainternals->first()->jumlah_objek, true);
        $templateProcessor->cloneBlock('clone7',$datapasars->count(),true);
        $templateProcessor->cloneBlock('clone8',$kerjainternals->first()->jumlah_objek, true);
        $templateProcessor->cloneBlock('clone9',$tanahs->count(),true);
        $templateProcessor->cloneBlock('clone10',$kerjainternals->first()->jumlah_objek, true); 
        $templateProcessor->cloneBlock('clone11',$bangunans->count(),true);
        $templateProcessor->cloneBlock('clone12',$kerjainternals->first()->jumlah_objek, true); 
        $templateProcessor->cloneBlock('clone13',$tanahs->count(),true);
        $templateProcessor->cloneBlock('clone14',$bangunans->count(),true);
        $templateProcessor->cloneBlock('clone15',$mesinspls->count(),true);
        //$templateProcessor->cloneBlock('clonelegalitas',$tanahs->count(), true);
        
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
         $nomor = 0;
         $nomor1 = 0;
         $nomor2 = 0;
         $nomor3 = 0;
         $nomor4 = 0;
         $nomor5 = 0;
         $nomor6 = 0;
         $nomor7 = 0;

        foreach($kerjainternals as $kerjainternal){

            $nip2 = User::where('name',$kerjainternal->users_id1)->first()->nip;
            $jabatan2 = User::where('name',$kerjainternal->users_id1)->first()->jabatan;
            $nomor++ ;
            $nomor1++;
            $nomor2++;
            $nomor3++;
            $nomor4++;
            $nomor5++;
            $nomor6++;

            $templateProcessor->setValue("nomor",$nomor,1);
            $templateProcessor->setValue("nomor1",$nomor1,1);
            $templateProcessor->setValue("nomor2",$nomor2,1);
            $templateProcessor->setValue("nomor3",$nomor3,1);
            $templateProcessor->setValue("nomor4",$nomor4,1);
            $templateProcessor->setValue("nomor5",$nomor5,1);
            $templateProcessor->setValue("nomor6",$nomor6,1);

            $templateProcessor->setValue("nama_debitur",$kerjainternal->nama_debitur,1);
            $templateProcessor->setValue("bu",$kerjainternal->bus->name,1);
            $templateProcessor->setValue("alamatbu",$kerjainternal->bus->alamatbu,1);
            $templateProcessor->setValue("pic",$kerjainternal->users->name,1);
            $templateProcessor->setValue("nip",$kerjainternal->users->nip,1);
            $templateProcessor->setValue("jabatan",$kerjainternal->users->jabatan,1);
            $templateProcessor->setValue("tanggal_terima",date('d M Y',strtotime($kerjainternal->tanggal_terima)),1);
            $templateProcessor->setValue("tanggal_suratbu",date('d M Y',strtotime($kerjainternal->tanggal_suratbu)),1);
            $templateProcessor->setValue("nosuratbu",$kerjainternal->nosuratbu,1);
            $templateProcessor->setValue("users_id1",$kerjainternal->users_id1,1);
            $templateProcessor->setValue("nip2",$nip2,1);
            $templateProcessor->setValue("jabatan2",$jabatan2,1);
            $templateProcessor->setValue("tujuan",$kerjainternal->tujuan,1);
            $templateProcessor->setValue("peruntukan",$kerjainternal->peruntukan,1);
            $templateProcessor->setValue("jumlah_lantai",$kerjainternal->jumlah_lantai,1);
            $templateProcessor->setValue("alamat",$kerjainternal->alamat,1);
            $templateProcessor->setValue("villages",$kerjainternal->villages,1);
            $templateProcessor->setValue("districs",$kerjainternal->districs,1);
            $templateProcessor->setValue("city",$kerjainternal->city,1);
            $templateProcessor->setValue("province",$kerjainternal->province,1);
            $templateProcessor->setValue("koordinat",$kerjainternal->koordinat,1);
            $templateProcessor->setValue("tanggal_penilaian",date('d M Y',strtotime($kerjainternal->tanggal_penilaian)),1);
            $templateProcessor->setValue("luas_tanah",number_format($kerjainternal->luas_tanah),1);
            $templateProcessor->setValue("luas_bangunan",number_format($kerjainternal->luas_bangunan),1);
            $templateProcessor->setValue("lebar_jalan",number_format($kerjainternal->lebar_jalan),1);
            $templateProcessor->setValue("kawasan",$kerjainternal->kawasan,1);
            $templateProcessor->setValue("bentuk_tanah",$kerjainternal->bentuk_tanah,1);
            $templateProcessor->setValue("frontage",$kerjainternal->frontage,1);
            $templateProcessor->setValue("elevasi",$kerjainternal->elevasi,1);

            foreach($tanahs as $tanah){
                if(($tanah->tanggal_berakhir) == null){
                    $tanggal_berakhir = null;
                } else $tanggal_berakhir = date('d-m-Y',strtotime($tanah->tanggal_berakhir));

                if (($kerjainternal->alamat) == ($tanah->alamat)){
                    $templateProcessor->setValue("no_gs",$tanah->no_gs,1);
                    $templateProcessor->setValue("no_gs1",$tanah->no_gs,1);
                    $templateProcessor->setValue("tgl_gs",date('d-m-Y',strtotime($tanah->tgl_gs)),1);
                    $templateProcessor->setValue("tgl_gs1",date('d-m-Y',strtotime($tanah->tgl_gs)),1);
                    $templateProcessor->setValue("jenis",$tanah->jenis,1);
                    $templateProcessor->setValue("no_sertifikat",$tanah->no_sertifikat,1);
                    $templateProcessor->setValue("tanggal_terbit",date('d M Y',strtotime($tanah->tanggal_terbit)),1);
                    $templateProcessor->setValue("tanggal_berakhir",$tanggal_berakhir,1);
                    $templateProcessor->setValue("atas_nama1",$tanah->atas_nama1,1);
                    $templateProcessor->setValue("luas_tanah2",$tanah->luas_tanah2,1);
                } else {
                    $templateProcessor->setValue("no_gs",null,1);
                    $templateProcessor->setValue("no_gs1",null,1);
                    $templateProcessor->setValue("tgl_gs",null,1);
                    $templateProcessor->setValue("tgl_gs1",null,1);
                    $templateProcessor->setValue("jenis",null,1);
                    $templateProcessor->setValue("no_sertifikat",null,1);
                    $templateProcessor->setValue("tanggal_terbit",null,1);
                    $templateProcessor->setValue("tanggal_berakhir",null,1);
                    $templateProcessor->setValue("atas_nama1",null,1);
                    $templateProcessor->setValue("luas_tanah2",null,1);
                }
            }

            foreach ($datapasars as $datapasar){
                if (($kerjainternal->alamat) == ($datapasar->alamat)){
                    $templateProcessor->setValue("penjual",$datapasar->penjual,1);
                    $templateProcessor->setValue("notelp",$datapasar->notelp,1);
                    $templateProcessor->setValue("peruntukan1",$datapasar->peruntukan1,1);
                    $templateProcessor->setValue("luas_tanah1",$datapasar->luas_tanah1,1);
                    $templateProcessor->setValue("luas_bangunan1",$datapasar->luas_bangunan1,1);
                    $templateProcessor->setValue("alamat1",$datapasar->alamat1,1);
                    $templateProcessor->setValue("villages1",$datapasar->villages1,1);
                    $templateProcessor->setValue("jarak_aktiva",$datapasar->jarak_aktiva,1);
                    $templateProcessor->setValue("harga_penawaran",number_format($datapasar->harga_penawaran),1);
                } else {
                    $templateProcessor->setValue("penjual",null,1);
                    $templateProcessor->setValue("notelp",null,1);
                    $templateProcessor->setValue("peruntukan1",null,1);
                    $templateProcessor->setValue("luas_tanah1",null,1);
                    $templateProcessor->setValue("luas_bangunan1",null,1);
                    $templateProcessor->setValue("alamat1",null,1);
                    $templateProcessor->setValue("villages1",null,1);
                    $templateProcessor->setValue("jarak_aktiva",null,1);
                    $templateProcessor->setValue("harga_penawaran",null,1);
                }
            }
            foreach ($bangunans as $bangunan){

                if(($bangunan->tgl_imb) == null){
                    $tgl_imb = null;
                } else $tgl_imb = date('d-m-Y',strtotime($bangunan->tgl_imb));
              
                $templateProcessor->setValue("no_imb",$bangunan->no_imb,1);
                $templateProcessor->setValue("tgl_imb",$tgl_imb,1);
               
                if (($kerjainternal->alamat) == ($bangunan->alamat)){
                    $templateProcessor->setValue("nama",$bangunan->nama,1);
                    $templateProcessor->setValue("jumlah_lantai",$bangunan->jumlah_lantai,1);
                    $templateProcessor->setValue("luas_bangunan2",$bangunan->luas_bangunan2,1);
                    $templateProcessor->setValue("kondisi_bangunan",$bangunan->kondisi_bangunan,1);
                    $templateProcessor->setValue("tahun_bangun",$bangunan->tahun_bangun,1);
                    $templateProcessor->setValue("struktur",$bangunan->struktur,1);
                    $templateProcessor->setValue("dinding",$bangunan->dinding,1);
                    $templateProcessor->setValue("lantai",$bangunan->lantai,1);
                    $templateProcessor->setValue("pintu_jendela",$bangunan->pintu_jendela,1);
                    $templateProcessor->setValue("atap",$bangunan->atap,1);
                } else {
                    $templateProcessor->setValue("nama",null,1);
                    $templateProcessor->setValue("jumlah_lantai",null,1);
                    $templateProcessor->setValue("luas_bangunan2",null,1);
                    $templateProcessor->setValue("kondisi_bangunan",null,1);
                    $templateProcessor->setValue("tahun_bangun",null,1);
                    $templateProcessor->setValue("struktur",null,1);
                    $templateProcessor->setValue("dinding",null,1);
                    $templateProcessor->setValue("lantai",null,1);
                    $templateProcessor->setValue("pintu_jendela",null,1);
                    $templateProcessor->setValue("atap",null,1);
                } 

            }

        }

        $npt_total = 0;
        $nlt_total = 0;
        $lttotal = 0;
        $npb_total = 0;
        $nlb_total = 0;
        $npm_total = 0;
        $nlm_total = 0;
        $total_sm = 0;
        foreach($kerjainternals as $kerjainternal){
                $nomor7++;
                $sm = $kerjainternal->nilai_sm;
                $total_sm += $sm;
                $templateProcessor->setValue("nomor7",$nomor7,1);
                $templateProcessor->setValue("peruntukan",$kerjainternal->peruntukan,1);
                $templateProcessor->setValue("alamat",$kerjainternal->alamat,1);
                $templateProcessor->setValue("villages",$kerjainternal->villages,1);
                $templateProcessor->setValue("districs",$kerjainternal->districs,1);
                $templateProcessor->setValue("city",$kerjainternal->city,1);
                $templateProcessor->setValue("province",$kerjainternal->province,1);
                $templateProcessor->setValue("koordinat",$kerjainternal->koordinat,1);
                $templateProcessor->setValue("npt",number_format($kerjainternal->nilai_pasar),1);
                $templateProcessor->setValue("nlt",number_format($kerjainternal->nilai_likuidasi),1);
                $templateProcessor->setValue("nilai_sm",number_format($kerjainternal->nilai_sm),1);
            
            foreach($tanahs as $tanah){
                           
                    $lt = $tanah->luas_tanah2;
                    $npt1 = $tanah->npt1;
                    $nlt1 = $tanah->nlt1;
                    $lttotal += $lt;
                    $npt_total += $npt1;
                    $nlt_total += $nlt1; 
    
                       if (($kerjainternal->alamat) == ($tanah->alamat)){
                            $templateProcessor->setValue("jenis",$tanah->jenis,1);
                            $templateProcessor->setValue("no_sertifikat",$tanah->no_sertifikat,1);
                            $templateProcessor->setValue("npt1",number_format($npt1),1);
                            $templateProcessor->setValue("nlt1",number_format($nlt1),1);
                            $templateProcessor->setValue("luas_tanah2", $lt, 1);
                        
                       } else {
                            $templateProcessor->setValue("jenis",null,1);
                            $templateProcessor->setValue("no_sertifikat",null,1);
                            $templateProcessor->setValue("npt1",null,1);
                            $templateProcessor->setValue("nlt1",null,1);
                            $templateProcessor->setValue("luas_tanah2", null, 1);
                            
                       }
            }  
        
            foreach($bangunans as $bangunan){
        
                $npb1 = $bangunan->npb1;
                $nlb1 = $bangunan->nlb1;
                $npb_total += $npb1;
                $nlb_total += $nlb1;
                    
                if (($kerjainternal->alamat) == ($bangunan->alamat)){
                    $templateProcessor->setValue("luas_bangunan2",number_format($bangunan->luas_bangunan2),1);
                    $templateProcessor->setValue("npb",number_format($npb1),1);
                    $templateProcessor->setValue("nlb",number_format($nlb1),1);
                    $templateProcessor->setValue("nama", $bangunan->nama, 1);
                } else {
                    $templateProcessor->setValue("luas_bangunan2",null,1);
                    $templateProcessor->setValue("npb",null,1);
                    $templateProcessor->setValue("nlb",null,1);
                    $templateProcessor->setValue("nama",null, 1);
                }
             } 
             
             foreach($mesinspls as $mesinspl){
        
                $npm = $mesinspl->npm1;
                $nlm = $mesinspl->nlm1;
                $npm_total += $npm;
                $nlm_total += $nlm;         
       
                if (($kerjainternal->alamat) == ($mesinspl->alamat)){
                    
                    $templateProcessor->setValue("nama_mesin", $mesinspl->nama_mesin, 1);
                    $templateProcessor->setValue("npm",number_format($npm),1);
                    $templateProcessor->setValue("nlm",number_format($nlm),1);
                } else {
                    $templateProcessor->setValue("nama_mesin", null, 1);
                    $templateProcessor->setValue("npm",null,1);
                    $templateProcessor->setValue("nlm",null,1);
                }
             } 
            
            $np_total = $npt_total + $npb_total + $npm_total ;
            $nl_total = $nlt_total + $nlb_total + $nlm_total ;

            $templateProcessor->setValue("hari_ini",date('d M Y'));
            $templateProcessor->setValue("np_total",number_format($np_total));
            $templateProcessor->setValue("nl_total",number_format($nl_total));
        
        }
        $templateProcessor->setValue("total_sm",number_format($total_sm));
        
        
        header("Content-Disposition: attachment; filename=penilaian_internal.docx");
        
        $templateProcessor->saveAs('php://output');
        
        return redirect()->route('kerjainternal.show')->with('toast','Laporan sudah terdownload'); 
        
    }
    
    public function destroy(Kerjainternal $kerjainternal)
    {
        $kerjainternal->delete();

        return redirect()->route('kerjainternal.show')->with('toast','Data sudah terhapus'); 
    }
}

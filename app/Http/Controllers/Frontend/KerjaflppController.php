<?php

namespace App\Http\Controllers\Frontend;

use App\Flpps;
use App\Http\Controllers\Controller;
use App\Kerjaflpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KerjaflppController extends Controller
{
    public function index()
    {
        $pengguna = Auth::user()->id;
        $flpps = Flpps::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);       
        
        return view('frontend.kerjaflpp.index',[
            'title' => "Beranda Inspeksi FLPP",
            'flpps' => $flpps,
               
            ]
        );
    }

    public function create(Request $request)
    {
        $pengguna = Auth::user()->id;
        $kerjaflpps = Flpps::join('kerjaflpp','flpps.id','=','kerjaflpp.flpps_id')
                        ->where('users_id',$pengguna)
                        ->where('status','!=','done')->first();  
        //user harus menyelesaikan satu nama debitur sampai selesai baru mengerjakan debitur yg lain
        if ($kerjaflpps != null) {
        $namadebt = $kerjaflpps->nama_debitur;
        $nama_debitur = $request->nama_debitur;
        if ($nama_debitur != $namadebt ){
            return redirect()->back()
            ->with('toast','oopss! order sebelumnya belum selesai. Pilih nama debitur yang sebelumnya... ');
        }}

        $nama_debitur = $request->nama_debitur;
        $flpps = Flpps::where('tanggal_selesai',null)->where('nama_debitur',$nama_debitur)->where('users_id',$pengguna)->first();
        
        if (Kerjaflpp::where('flpps_id',$flpps->id)->count()>= 1){
            return redirect()->route('kerjaflpp.show')
            ->with('toast','Oopss! tidak bisa tambah objek ya... ');
        } 

        Kerjaflpp::create([
            'flpps_id' =>$flpps->id,
        ]);
        
        return redirect()->route('kerjaflpp.show')->with('toast','Data objek sudah ditambah, silahkan lengkapi/edit');
    }

    public function edit(Kerjaflpp $kerjaflpp)
    {
        return view('frontend.kerjaflpp.create', [
            'title' => 'Edit Data Inspeksi FLPP',
            'kerjaflpp'=> $kerjaflpp,
            ]);
    }

    public function update(Request $request, Kerjaflpp $kerjaflpp)
    {     
        
        $z = date_create($request->tanggal_inspeksi);
        $tanggal_inspeksi = date_format($z,"Y/m/d");

        $x = date_create($request->tanggal_terbit);
        $tanggal_terbit = date_format($x,"Y/m/d");

        $g = date_create($request->tanggal_terbit);
        $tgl_gs = date_format($g,"Y/m/d");

        $h = date_create($request->tanggal_imb);
        $tanggal_imb = date_format($h,"Y/m/d");


        if (($request->tanggal_berakhir)== null){
            $tanggal_berakhir = null;
        } else {
            $y = date_create($request->tanggal_berakhir);
            $tanggal_berakhir = date_format($y,"Y/m/d");
        }
        
        function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     
            return preg_replace('/-+/', '', $string); // Replaces multiple hyphens with single one.
         }

        $this->validate($request,[  
            'keterangan'=> 'required',
            
            'tanggal_inspeksi'=>'required',
            'legalitas' =>'required',
            'no_sertifikat'=>'required',
            'tanggal_terbit' => 'required',
            'no_gs' =>'required',
            'tgl_gs' =>'required',
            'atas_nama' =>'required',
            'no_imb'=>'required',
            'tanggal_imb' => 'required',
            'kondisi_jalan'=>'required',
            'kondisi_drainase'=>'required',
            'listrik'=>'required',
            'air'=>'required',
            'luas_tanah' => 'required',
            'luas_bangunan' => 'required',
            'blok' => 'required',
            'koordinat'=>'required',
            'gambar_flpp' => 'file|image',
            'lebar_jalan' => 'required',
            'sekolah' =>'required',
            'pasar' => 'required',
            'spbu' => 'required',
            'ibadah' => 'required',
            'kuburan' => 'required',

        ]);
       
        $nama_gambar = $kerjaflpp->gambar_flpp;
        
        if ($request->file('gambar_flpp')){
            Storage::delete($nama_gambar);
           
            $file = $request->file('gambar_flpp');
            $nama_gambar = time()."-".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/gambar_flpp';
            $file->move($tujuan_upload,$nama_gambar);
        }
        
 
        $alamatclear = clean($request->blok);

        $kerjaflpp->update([
            
            'tanggal_inspeksi' => $tanggal_inspeksi,
            'legalitas' =>$request->legalitas,
            'no_sertifikat'=>$request->no_sertifikat,
            'tanggal_terbit' => $tanggal_terbit,
            'no_gs' =>$request->no_gs,
            'tgl_gs' =>$tgl_gs,
            'atas_nama' =>$request->atas_nama,
            'no_imb'=>$request->no_imb,
            'tanggal_imb' => $tanggal_imb,
            'kondisi_jalan'=>$request->kondisi_jalan,
            'kondisi_drainase'=>$request->kondisi_drainase,
            'listrik'=>$request->listrik,
            'air'=>$request->air,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'blok' => $alamatclear,
            'koordinat'=>$request->koordinat,
            'gambar_flpp' => $nama_gambar,
            'tanggal_berakhir' => $tanggal_berakhir,
            'keterangan' => $request->keterangan,
            'lebar_jalan' => $request->lebar_jalan,
            'sekolah' => $request->sekolah,
            'pasar' => $request->pasar,
            'spbu' => $request->spbu,
            'ibadah' => $request->ibadah,
            'kuburan' => $request->kuburan,
            'tahun_bangun' => $request->tahun_bangun
             

        ]);

        return redirect()->route('kerjaflpp.show')->with('toast','data sudah terupdate'); 
    }
    public function data()
    {
        $pengguna = Auth::user()->id;
    
        $kerjaflpps = Flpps::join('kerjaflpp','flpps.id','=','kerjaflpp.flpps_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($kerjaflpps)
                            ->addColumn('bu',function(Flpps $model){
                                    
                                    return $model->bus->name;
                            })
                            ->addColumn('developer',function(Flpps $model){
                                    
                                return $model->developers->name;
                            })
                            ->addColumn('action','frontend.kerjaflpp.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();
    }

    public function show(Kerjaflpp $kerjaflpp)
    {
        
 
       $pengguna = Auth::user()->id;

       $kerjaflpps = Flpps::join('kerjaflpp','flpps.id','=','kerjaflpp.flpps_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();
       
        return view('frontend.kerjaflpp.show',[
            'title' => 'Daftar Objek',
            'kerjaflpps' => $kerjaflpps,
        ]);
        
    }

    public function laporan()
    {
        $pengguna = Auth::user()->id;
        
        $kerjaflpps = Flpps::join('kerjaflpp','flpps.id','=','kerjaflpp.flpps_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

      
        $flpps = Flpps::where('tanggal_selesai',null)->where('users_id',$pengguna)->get();
       

        require 'C:\Users\Mujahidin\vendor\autoload.php';
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(public_path('inspeksi_FLPP.docx'));
       

        foreach($kerjaflpps as $kerjaflpp){
            if (($kerjaflpp->tanggal_berakhir) == null){
                $tanggal_berakhir = null;
            } else $tanggal_berakhir = date('d M Y',strtotime($kerjaflpp->tanggal_berakhir));

            $templateProcessor->setValue("nama_debitur",$kerjaflpp->nama_debitur,1);
            $templateProcessor->setValue("bu",$kerjaflpp->bus->name,1);
            $templateProcessor->setValue("alamatbu",$kerjaflpp->bus->alamatbu,1);
            $templateProcessor->setValue("pic",$kerjaflpp->users->name,1);
            $templateProcessor->setValue("nip",$kerjaflpp->users->nip,1);
            $templateProcessor->setValue("jabatan",$kerjaflpp->users->jabatan,1);
            $templateProcessor->setValue("tanggal_suratbu",date('d M Y',strtotime($kerjaflpp->tanggal_suratbu)),1);
            $templateProcessor->setValue("nosuratbu",$kerjaflpp->nosuratbu,1);
            $templateProcessor->setValue("lokasi",$kerjaflpp->developers->lokasi,1);
            $templateProcessor->setValue("developer",$kerjaflpp->developers->name,1);
            $templateProcessor->setValue("projek",$kerjaflpp->developers->projek,1);
            $templateProcessor->setValue("koordinat",$kerjaflpp->koordinat,1);
            $templateProcessor->setValue("blok",$kerjaflpp->blok,1);
            $templateProcessor->setValue("tanggal_inspeksi",date('d M Y',strtotime($kerjaflpp->tanggal_inspeksi)),1);
            $templateProcessor->setValue("lt",number_format($kerjaflpp->luas_tanah),1);
            $templateProcessor->setValue("lb",number_format($kerjaflpp->luas_bangunan),1);
            $templateProcessor->setValue("legalitas",$kerjaflpp->legalitas,1);
            $templateProcessor->setValue("no_sertifikat",$kerjaflpp->no_sertifikat,1);
            $templateProcessor->setValue("tanggal_terbit",date('d M Y',strtotime($kerjaflpp->tanggal_terbit)),1);
            $templateProcessor->setValue("tanggal_berakhir",$tanggal_berakhir,1);
            $templateProcessor->setValue("lebar_jalan",number_format($kerjaflpp->lebar_jalan),1);
            $templateProcessor->setValue("kondisi_jalan",$kerjaflpp->kondisi_jalan,1);
            $templateProcessor->setValue("kondisi_drainase",$kerjaflpp->kondisi_drainase,1);
            $templateProcessor->setValue("listrik",$kerjaflpp->listrik,1);
            $templateProcessor->setValue("air",$kerjaflpp->air,1);
            $templateProcessor->setValue("thn",$kerjaflpp->tahun_bangun,1);
            $templateProcessor->setValue("sekolah",$kerjaflpp->sekolah,1);
            $templateProcessor->setValue("pasar",$kerjaflpp->pasar,1);
            $templateProcessor->setValue("spbu",$kerjaflpp->spbu,1);
            $templateProcessor->setValue("ibadah",$kerjaflpp->ibadah,1);
            $templateProcessor->setValue("kuburan",$kerjaflpp->kuburan,1);
            $templateProcessor->setValue("no_imb",$kerjaflpp->no_imb,1);
            $templateProcessor->setValue("tanggal_imb",date('d M Y',strtotime($kerjaflpp->tanggal_imb)),1);
        }

        foreach($kerjaflpps as $kerjaflpp){
            
            if (($kerjaflpp->tanggal_berakhir) == null){
                $tanggal_berakhir = null;
            } else $tanggal_berakhir = date('d M Y',strtotime($kerjaflpp->tanggal_berakhir));

            $templateProcessor->setValue("nama_debitur",$kerjaflpp->nama_debitur,1);
            $templateProcessor->setValue("pic",$kerjaflpp->users->name,1);
            $templateProcessor->setValue("lokasi",$kerjaflpp->developers->lokasi,1);
            $templateProcessor->setValue("developer",$kerjaflpp->developers->name,1);
            $templateProcessor->setValue("projek",$kerjaflpp->developers->projek,1);
            $templateProcessor->setValue("koordinat",$kerjaflpp->koordinat,1);
            $templateProcessor->setValue("blok",$kerjaflpp->blok,1);
            $templateProcessor->setValue("tanggal_inspeksi",date('d M Y',strtotime($kerjaflpp->tanggal_inspeksi)),1);
            $templateProcessor->setValue("lt",number_format($kerjaflpp->luas_tanah),1);
            $templateProcessor->setValue("lb",number_format($kerjaflpp->luas_bangunan),1);
            $templateProcessor->setValue("legalitas",$kerjaflpp->legalitas,1);
            $templateProcessor->setValue("no_sertifikat",$kerjaflpp->no_sertifikat,1);
            $templateProcessor->setValue("tanggal_terbit",date('d M Y',strtotime($kerjaflpp->tanggal_terbit)),1);
            $templateProcessor->setValue("tanggal_berakhir",$tanggal_berakhir,1);
            $templateProcessor->setValue("kondisi_jalan",$kerjaflpp->kondisi_jalan,1);
            $templateProcessor->setValue("kondisi_drainase",$kerjaflpp->kondisi_drainase,1);
            $templateProcessor->setValue("listrik",$kerjaflpp->listrik,1);
            $templateProcessor->setValue("air",$kerjaflpp->air,1);
            $templateProcessor->setValue("thn",$kerjaflpp->tahun_bangun,1);
            $templateProcessor->setValue("no_imb",$kerjaflpp->no_imb,1);
            $templateProcessor->setValue("tanggal_imb",date('d M Y',strtotime($kerjaflpp->tanggal_imb)),1);
        }

        $templateProcessor->setValue("hari_ini",date('d M Y'));
  
        
        header("Content-Disposition: attachment; filename=inspeksi_FLPP.docx");
        
        $templateProcessor->saveAs('php://output');
        
        return redirect()->route('kerjaflpp.show')->with('toast','Laporan sudah terdownload'); 
        
    }

    public function destroy(Kerjaflpp $kerjaflpp)
    {
        $kerjaflpp->delete();

        return redirect()->route('kerjaflpp.show')->with('toast','Data sudah terhapus'); 
    }
}

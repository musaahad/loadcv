<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Developer;

use App\User;

use App\Bus;
use App\Flpps;

class FlppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.flpps.index',[
            'title' => 'Data Debitur Inspeksi FLPP',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.flpps.create',[
            'title' => 'Tambah Order Inspeksi FLPP',
            'developer' => Developer::orderBy('name','ASC')->get(),
            'bus' => Bus::orderBy('name','ASC')->get(),
            'users' => User::orderBy('name','ASC')->get(),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_debitur'=>'required|min:3',
            'keterangan'=> 'required',
            'perumahan' => 'required',
            'nosuratbu' => 'required',
            'tanggal_suratbu' => 'required',
            'tanggal_terima' => 'required',
            // 'tanggal_inspeksi' => 'required',
            // 'alamat' => 'required',
            // 'kelurahan' => 'required',
            // 'kecamatan' => 'required',
            // 'kota' => 'required',
            // 'legalitas' => 'required',
            // 'no_sertifikat' => 'required',
            // 'tanggal_terbit' => 'required',
            // 'luas_tanah' => 'required',
            // 'luas_bangunan' => 'required',
            // 'kondisi_jalan' => 'required',
            // 'kondisi_drainase' => 'required',
            // 'listrik' => 'required',
            // 'air' => 'required',


        ]);
        Flpps::create([
            'nama_debitur'=>$request->nama_debitur,
            'developer_id' =>$request->developer_id,
            'tanggal_suratbu'=>$request->tanggal_suratbu,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'bus_id' =>$request->bus_id,
            'users_id' =>$request->users_id,
            'keterangan'=>$request->keterangan,
            'perumahan' => $request->perumahan,
            'nosuratbu' => $request->nosuratbu,
            'perumahan' => $request->perumahan,
            'tanggal_terima'=>$request->tanggal_terima,
            // 'tanggal_inspeksi'=>$request->tanggal_inspeksi,
            // 'alamat' => $request->alamat,
            // 'kelurahan' => $request->kelurahan,
            // 'kecamatan' => $request->kecamatan,
            // 'kota' => $request->kota,
            // 'legalitas' => $request->legalitas,
            // 'no_sertifikat' => $request->no_sertifikat,
            // 'no_imb' => $request->no_imb,
            // 'tgl_imb' => $request->tgl_imb,
            // 'tanggal_terbit'=>$request->tanggal_terima,
            // 'tanggal_berakhir'=>$request->tanggal_berakhir,
            // 'luas_tanah' => $request->luas_tanah,
            // 'luas_bangunan' => $request->luas_bangunan,
            // 'kondisi_jalan' => $request->kondisi_jalan,
            // 'kondisi_drainase' => $request->drainase,
            // 'listrik' => $request->listrik,
            // 'air' => $request->air,
            'status' => $request->status,

        ]);

        return redirect()->route('admin.flpps.index')
        ->with('success',' Data Order Inspeksi FLPP baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Flpps $flpp)
    {
        return view('admin.flpps.edit', [
            'title' => 'Ubah data inspeksi FLPP',
            'flpp' => $flpp,
            'developer' => Developer::orderBy('name','ASC')->get(),
            'bus' => Bus::orderBy('name','ASC')->get(),
            'users' => User::orderBy('name','ASC')->get(),
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flpps $flpp)
    {
        $this->validate($request,[
            'nama_debitur'=>'required|min:3',
            'keterangan'=> 'required',
            'perumahan' => 'required',
            'nosuratbu' => 'required',
            'tanggal_suratbu' => 'required',
            'tanggal_terima' => 'required',
            // 'tanggal_inspeksi' => 'required',
            // 'alamat' => 'required',
            // 'kelurahan' => 'required',
            // 'kecamatan' => 'required',
            // 'kota' => 'required',
            // 'legalitas' => 'required',
            // 'no_sertifikat' => 'required',
            // 'tanggal_terbit' => 'required',
            // 'luas_tanah' => 'required',
            // 'luas_bangunan' => 'required',
            // 'kondisi_jalan' => 'required',
            // 'kondisi_drainase' => 'required',
            // 'listrik' => 'required',
            // 'air' => 'required',
        ]);
        $flpp->update([
            'nama_debitur'=>$request->nama_debitur,
            'developer_id' =>$request->developer_id,
            'tanggal_suratbu'=>$request->tanggal_suratbu,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'bus_id' =>$request->bus_id,
            'users_id' =>$request->users_id,
            'keterangan'=>$request->keterangan,
            'perumahan' => $request->perumahan,
            'nosuratbu' => $request->nosuratbu,
            'perumahan' => $request->perumahan,
            'tanggal_terima'=>$request->tanggal_terima,
            // 'tanggal_inspeksi'=>$request->tanggal_inspeksi,
            // 'alamat' => $request->alamat,
            // 'kelurahan' => $request->kelurahan,
            // 'kecamatan' => $request->kecamatan,
            // 'kota' => $request->kota,
            // 'legalitas' => $request->legalitas,
            // 'no_sertifikat' => $request->no_sertifikat,
            // 'no_imb' => $request->no_imb,
            // 'tgl_imb' => $request->tgl_imb,
            // 'tanggal_terbit'=>$request->tanggal_terima,
            // 'tanggal_berakhir'=>$request->tanggal_berakhir,
            // 'luas_tanah' => $request->luas_tanah,
            // 'luas_bangunan' => $request->luas_bangunan,
            // 'kondisi_jalan' => $request->kondisi_jalan,
            // 'kondisi_drainase' => $request->drainase,
            // 'listrik' => $request->listrik,
            // 'air' => $request->air,
             'status' => $request->status,
        ]);

        return redirect()->route('admin.flpps.index')
        ->with('success',' Data Load Inspeksi FLPP berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flpps $flpp)
    {
        $flpp->delete();

       return redirect()->route('admin.flpps.index')
        ->with('danger',' Data Inspeksi FLPP sudah dihapus');
    }
}

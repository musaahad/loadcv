<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bus;
use App\User;
use App\Developer;
use App\Vercall;

class VercallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.vercall.index',[
            'title' => 'Data Debitur Verifikasi Progress',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vercall.create',[
            'title' => 'Tambah Order Review',
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
            'jumlah_objek'=> 'required|numeric',
            'keterangan'=> 'required',
        ]);
        Vercall::create([
            'nama_debitur'=>$request->nama_debitur,
            'jumlah_objek'=>$request->jumlah_objek,
            'developers_id' =>$request->developers_id,
            'tanggal_order'=>$request->tanggal_order,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'bus_id' =>$request->bus_id,
            'users_id' =>$request->users_id,
          
            'keterangan'=>$request->keterangan,
        ]);

        return redirect()->route('admin.vercall.index')
        ->with('success',' Data Order Vercall baru berhasil ditambahkan');
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
    public function edit(Vercall $vercall)
    {
        return view('admin.vercall.edit', [
            'title' => 'Ubah data Verifikasi Progress',
            'vercall' => $vercall,
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
    public function update(Request $request, Vercall $vercall)
    {
        $this->validate($request,[
            'nama_debitur'=>'required|min:3',
           'jumlah_objek'=> 'required|numeric',
           'keterangan'=> 'required',
        ]);
        $vercall->update([
            'nama_debitur'=>$request->nama_debitur,
            'jumlah_objek'=>$request->jumlah_objek,
            'developers_id' =>$request->developers_id,
            'tanggal_order'=>$request->tanggal_order,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'bus_id' =>$request->bus_id,
            'users_id' =>$request->users_id,
          
            'keterangan'=>$request->keterangan,
        ]);

        return redirect()->route('admin.vercall.index')
        ->with('success',' Data Load Verifikasi Progress berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vercall $vercall)
    {
        $vercall->delete();

        return redirect()->route('admin.vercall.index')
         ->with('danger',' Data Load Verifikasi Progress sudah dihapus');
    }
}

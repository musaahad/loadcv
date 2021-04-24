<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BU;
use App\Bus;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         return view('admin.bus.index',[
             'title' => 'Daftar Bisnis Unit',
         ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bus.create',[
            'title' => 'Tambah Bisnis Unit',
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
            'name'=>'required|min:3',
            'tar_tat'=> 'required',
            'jenis_order' => 'required',
            'alamatbu' => 'required',
        ]);
        
        Bus::create([
            'name'=>$request->name,
            'alamatbu'=>$request->alamatbu,
            'jenis_order' => $request->jenis_order,
            'tar_tat'=>$request->tar_tat,
        ]);

        return redirect()->route('admin.bus.index')
        ->with('success', ' Data BU baru berhasil ditambahkan');
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
    public function edit(Bus $bu)
    {
        return view('admin.bus.edit', [
            'title' => 'Edit Bisnis Unit',
            'bu' =>$bu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bu)
    {
        $this->validate($request,[
            'name'=>'required|min:3',
            'tar_tat'=> 'required',
            'jenis_order' => 'required',
            'alamatbu' => 'required',
        ]);
        
        $bu->update([
            'name'=>$request->name,
            'tar_tat'=>$request->tar_tat,
            'jenis_order' => $request->jenis_order,
            'alamatbu'=>$request->alamatbu,
            
            ]);

        return redirect()->route('admin.bus.index')
        ->with('info', ' Data BU berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bu)
    {
        $bu->delete();

        return redirect()->route('admin.bus.index')
        ->with('danger', ' Data BU berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Holidays;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         return view('admin.holidays.index',[
             'title' => 'Daftar Hari Libur',
         ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.holidays.create',[
            'title' => 'Tambah Hari Libur',
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
            'tanggal_libur'=>'required',
          
        ]);
        
        Holidays::create([
            'tanggal_libur'=>$request->tanggal_libur,
            'catatan'=>$request->catatan,
        ]);

        return redirect()->route('admin.holidays.index')
        ->with('success', ' Data hari libur berhasil ditambahkan');
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
    public function edit(Holidays $holiday)
    {
        return view('admin.holidays.edit', [
            'title' => 'Edit Hari Libur',
            'holiday' =>$holiday,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holidays $holiday)
    {
        $this->validate($request,[
            'tanggal_libur'=>'required',
        ]);
        
        $holiday->update([
            'tanggal_libur'=>$request->tanggal_libur,
            'catatan'=>$request->catatan,
            
            ]);

        return redirect()->route('admin.holidays.index')
        ->with('info', ' Data hari libur berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holidays $holiday)
    {
        $holiday->delete();

        return redirect()->route('admin.holidays.index')
        ->with('danger', ' Data hari libur berhasil dihapus');
    }
}


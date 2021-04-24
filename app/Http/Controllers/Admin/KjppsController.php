<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kjpps;


class KjppsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kjpps.index',[
            'title' => 'Data Kantor Jasa Penilai Publik (KJPP)',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kjpps.create',[
            'title' => 'Tambah Data Kantor Jasa Penilai Publik (KJPP)',
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
            'pimpinan'=>'required',
            'nomappi' =>'required',
            'ijinpublik'=>'required',
            'klasifikasi'=>'required',
        ]);

        Kjpps::create([
            'name'=>$request->name,
            'pimpinan'=>$request->pimpinan,
            'nomappi' =>$request->nomappi,
            'ijinpublik'=>$request->ijinpublik,
            'klasifikasi' => $request->klasifikasi,
        ]);

        return redirect()->route('admin.kjpps.index')
        ->with('success', ' Data KJPP baru berhasil ditambahkan');

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
    public function edit(Kjpps $kjpp)
    {
        return view('admin.kjpps.edit', [
            'title' => 'Edit Data KJPP',
            'kjpp' =>$kjpp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kjpps $kjpp)
    {
        $this->validate($request,[
            'name'=>'required|min:3',
            'pimpinan'=>'required',
            'nomappi' =>'required',
            'ijinpublik'=>'required',
            'klasifikasi'=>'required',
        ]);

        $kjpp->update([
            'name'=>$request->name,
            'pimpinan'=>$request->pimpinan,
            'nomappi' =>$request->nomappi,
            'ijinpublik'=>$request->ijinpublik,
            'klasifikasi' => $request->klasifikasi,
        ]);

        return redirect()->route('admin.kjpps.index')
        ->with('info', ' Data KJPP berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kjpps $kjpp)
    {
        $kjpp->delete();

        return redirect()->route('admin.kjpps.index')
        ->with('danger', ' Data KJPP berhasil dihapus');
    }
}

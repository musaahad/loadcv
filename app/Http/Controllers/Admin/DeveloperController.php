<?php

namespace App\Http\Controllers\Admin;

use App\Developer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.developer.index',[
            'title' => 'Daftar Developer',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.developer.create',[
            'title' => 'Tambah Developer',
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
            'tiering'=> 'required'
        ]);
        
        Developer::create([
            'name'=>$request->name,
            'tiering'=>$request->tiering,
            'projek' => $request->projek,
            'lokasi' => $request->lokasi
        ]);

        return redirect()->route('admin.developer.index')
        ->with('success', ' Data developer baru berhasil ditambahkan');
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
    public function edit(Developer $developer)
    {
        return view('admin.developer.edit', [
            'title' => 'Edit Developer',
            'developer' =>$developer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Developer $developer)
    {
        $this->validate($request,[
            'name'=>'required|min:3',
            'tiering'=> 'required'
        ]);
        
        $developer->update(
            ['name'=>$request->name,
            'tiering'=>$request->tiering,
            'projek' => $request->projek,
            'lokasi' => $request->lokasi
            ]
        );

        return redirect()->route('admin.developer.index')
        ->with('info', ' Data developer berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Developer $developer)
    {
        $developer->delete();

        return redirect()->route('admin.developer.index')
        ->with('danger', ' Data developer berhasil dihapus');
    }
}

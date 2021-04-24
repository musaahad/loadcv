<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class PicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index',[
            'title' => 'Daftar PIC/Users',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create',[
            'title' => 'Tambah Petugas',
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
            'nip'=> 'required',
            'jabatan' => 'required',
            'panggilan' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:5',
        ]);
        
        User::create([
            'name'=>$request->name,
            'nip'=>$request->nip,
            'jabatan' => $request->jabatan,
            'panggilan'=>$request->panggilan,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('admin.users.index')
        ->with('success', ' Data PIC baru berhasil ditambahkan');
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
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'title' => 'Edit Data PIC',
            'user' =>$user,
        ]);
    }

    public function reset(User $user)
    {
        return view('admin.users.reset', [
            'title' => 'Reset Password PIC',
            'user' =>$user,
        ]);
    }

    public function updatereset(Request $request, User $user)
    {
        
        $this->validate($request,[
            // 'name'=>'required|min:3',
            // 'nip'=> 'required',
            // 'jabatan' => 'required',
            // 'panggilan' => 'required',
            // 'email' => 'required|string|email|max:255|unique:users',
          
        ]);
        
        $user->update([
            'name'=>$request->name,
            'nip'=>$request->nip,
            'jabatan' => $request->jabatan,
            'panggilan'=>$request->panggilan,
            'email' => $request->email,
           
            
            ]);

        return redirect()->route('login')
        ->with('info', ' Password berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        
        $this->validate($request,[
            // 'name'=>'required|min:3',
            // 'nip'=> 'required',
            // 'jabatan' => 'required',
            // 'panggilan' => 'required',
            // 'email' => 'required|string|email|max:255|unique:users',
          
        ]);
        
        $user->update([
            'name'=>$request->name,
            'nip'=>$request->nip,
            'jabatan' => $request->jabatan,
            'panggilan'=>$request->panggilan,
            'email' => $request->email,
           
            
            ]);

        return redirect()->route('admin.users.index')
        ->with('info', ' Data PIC berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
        ->with('danger', ' Data PIC berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Illuminate\Support\Facades\Auth;
use App\Kerjareview;
use App\Reviews;
use App\Internal;
use App\Flpps;
use App\Vercall;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        //
        //$pengguna = Auth::user()->id;
        //$reviews = Reviews::where('tanggal_selesai',null)->where('users_id',$pengguna)->get();
        //$kerjarvs = $reviews->first()->id;
        //$kerjarv = Kerjareview::where('reviews_id',$kerjarvs)->get();
        
        //return view('home',[
        //    'title' => Auth::user()->name,
        //    'reviews'=>$reviews,
        //    'kerjarv'=>$kerjarv,
            
        //]);
        
        $pengguna = Auth::user()->id;
        $reviews = Reviews::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);
        $internals = Internal::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);
        $flpps = Flpps::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);
        $vercalls = Vercall::where('tanggal_selesai', null)->where('users_id',$pengguna)->paginate(5);
        
        
        return view('home',[
            'title' =>  Auth::user()->name,
            'reviews' => $reviews,
            'user' => $user,
            'internals' => $internals,
            'flpps' => $flpps,
            'vercalls'=> $vercalls,            
            ]
        );
    }
}

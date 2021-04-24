<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kerjareview;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Province;
use App\City;
use App\Districs;
use App\Villages;
use App\Reviews;

class DataController extends Controller
{
    public function index(Request $request)
    {

        // if ($request->ajax()) {
        //     $data = Kerjareview::latest()->get();
        //     return datatables()->of($data)
        //             ->addIndexColumn()
        //             ->addColumn('action', function($row){

        //                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Edit</a>';

        //                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCustomer">Delete</a>';

        //                     return $btn;
        //             })
        //             ->rawColumns(['action'])
        //             ->make(true);
        // }

        // return view('CustomerAjax');

        $pengguna = Auth::user()->id;
    
        $kerjareviews = Reviews::join('kerjareview','reviews.id','=','kerjareview.reviews_id')
                            ->where('users_id',$pengguna)
                            ->where('status','!=','done')
                            ->get();

        return datatables()->of($kerjareviews)
                           ->addColumn('NP Total',function(Reviews $model){
                                $npt = $model->npt;
                                return number_format($npt);
                            })
                            ->addColumn('NL Total',function(Reviews $model){
                                $nlt = $model->nlt;
                                return number_format($nlt);
                            })
                            ->addColumn('Np/m2',function(Reviews $model){
                                $np_permeter = $model->np_permeter;
                                return number_format($np_permeter);
                            })
                          
                            ->addColumn('action','frontend.kerjareview.action')
                            ->addIndexColumn()
                            ->rawColumns(['action'])
                            ->toJson();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kerjareview $kerjareview)
    {
        $npt = str_replace('.','',$request->npt);
        $nlt = str_replace('.','',$request->nlt);
        $np_permeter = str_replace('.','',$request->np_permeter);      
        
        $x = date_create($request->tanggal_lengkap);
        $tanggal_lengkap = date_format($x,"Y/m/d");
        
        $y = date_create($request->tanggal_inspeksi);
        $tanggal_inspeksi = date_format($y,"Y/m/d");

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
        
        $this->validate($request,[  
            'keterangan'=> 'required',
            'tanggal_lengkap'=>'required',
            'tanggal_inspeksi'=>'required',
            'tanggal_penilaian'=>'required',
            'peruntukan' =>'required',
            'pendekatan'=>'required',
            'bentuk_tanah' =>'required',
            'posisi' =>'required',
            'frontage'=>'required',
            'lebar_jalan'=>'required',
            'koordinat'=>'required',
            'alamat'=>'required',
            'villages'=>'required',
            'districs'=>'required',
            'city'=>'required',
            'province'=>'required',
            'npt' =>'required',
            'nlt' =>'required',
            'np_permeter' => 'required',
        ]);


        
        $kerjareview = Kerjareview::updateOrCreate([
            'tanggal_lengkap'=>$tanggal_lengkap,
            'tanggal_inspeksi'=>$tanggal_inspeksi,
            'tanggal_penilaian'=>$tanggal_penilaian,
            'peruntukan' =>$request->peruntukan,
            'pendekatan'=>$request->pendekatan,
            'bentuk_tanah' =>$request->bentuk_tanah,
            'posisi' =>$request->posisi,
            'frontage'=>$request->frontage,
            'lebar_jalan'=>$request->lebar_jalan,
            'koordinat'=>$request->koordinat,
            'alamat'=>$request->alamat,
            'villages'=>$villages,
            'districs'=>$districs,
            'city'=>$city,
            'province'=>$province,
            'npt' =>$npt,
            'nlt' =>$nlt,
            'lt_total' =>$request->lt_total,
            'lb_total' =>$request->lb_total,
            'np_permeter' =>$np_permeter,
            'keterangan'=>$request->keterangan,
            ]);        

        return response()->json($kerjareview);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kerjareview = Kerjareview::find($id);
        return response()->json($kerjareview);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    
}

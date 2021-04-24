<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Bus;
use App\Internal;
use App\Holidays;


class InternalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.internal.index',[
            'title' => 'Data Load Penilaian Internal',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.internal.create',[
            'title' => 'Tambah Order Penilaian Internal',
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
        
       
        function getWorkingDays($startDate,$endDate,$holidays) {
            // do strtotime calculations just once
            $endDate = strtotime($endDate);
            $startDate = strtotime($startDate);
    
            //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
            //We add one to inlude both dates in the interval.
            $days = ($endDate - $startDate) / 86400 + 1;
    
            $no_full_weeks = floor($days / 7);
            $no_remaining_days = fmod($days, 7);
    
            //It will return 1 if it's Monday,.. ,7 for Sunday
            $the_first_day_of_week = date("N", $startDate);
            $the_last_day_of_week = date("N", $endDate);
    
            //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
            //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
            if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
            }
    
            else {
                // (edit by Tokes to fix an edge case where the start day was a Sunday
                // and the end day was NOT a Saturday)
    
                // the day of the week for start is later than the day of the week for end
            if ($the_first_day_of_week == 7) {
                // if the start date is a Sunday, then we definitely subtract 1 day
            $no_remaining_days--;
    
            if ($the_last_day_of_week == 6) {
                // if the end date is a Saturday, then we subtract another day
                $no_remaining_days--;
            }
            }
            else {
            // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
            // so we skip an entire weekend and subtract 2 days
                $no_remaining_days -= 2;
                }
            }
        
            //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
            //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
                $workingDays = $no_full_weeks * 5;
                if ($no_remaining_days > 0 )
            {
                $workingDays += $no_remaining_days;
            }
    
            //We subtract the holidays
                foreach($holidays as $holiday){
                $time_stamp=strtotime($holiday);
            //If the holiday doesn't fall in weekend
                if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
            $workingDays--;
            }
    
                return $workingDays;
            }

            $liburan = Holidays::select('tanggal_libur')->get();
            $x = $liburan->implode('tanggal_libur',',');
            $l = explode(',',$x);
                        
            $tanggal_awal = $request->tanggal_terima;
            if ($request->tanggal_selesai == null){
                $hari_ini = now();}
            else $hari_ini = $request->tanggal_selesai;
            $holidays = $l;
                        
            $tat_aktual = round(getWorkingDays($tanggal_awal,$hari_ini,$holidays));
            
            if(is_numeric($request->users_id1) == false){
                $users_id1 = ($request->users_id1);
            } else $users_id1 = User::where('id',$request->users_id1)->first()->name;
        
        $this->validate($request,[
            'nama_debitur'=>'required|min:3',
            'jumlah_objek'=> 'required|numeric',
            'keterangan'=> 'required',
            'nama_debitur'=>'required',
            'nosuratbu' => 'required',
            'tujuan' => 'required',
            'tanggal_suratbu'=>'required',
            'tanggal_terima'=>'required',
            
        ]);
        Internal::create([
            'nama_debitur'=>$request->nama_debitur,
            'nosuratbu' => $request->nosuratbu,
            'tujuan' => $request->tujuan,
            'jumlah_objek'=>$request->jumlah_objek,
            'tanggal_suratbu'=>$request->tanggal_suratbu,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'tanggal_terima'=>$request->tanggal_terima,
            'bus_id' =>$request->bus_id,
            'users_id' =>$request->users_id,
            'users_id1' =>$users_id1,
            'status' => $request->status,
            'tat_aktual' => $request->$tat_aktual,
            'keterangan'=>$request->keterangan,
            'cif' => $request->cif,
        ]);

        return redirect()->route('admin.internal.index')
        ->with('success',' Data Order Penilaian Internal baru berhasil ditambahkan');
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
    public function edit(Internal $internal)
    {
        return view('admin.internal.edit', [
            'title' => 'Ubah data pending review',
            'internal' => $internal,
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
    public function update(Request $request, Internal $internal)
    {
       
        function getWorkingDay($startDate,$endDate,$holidays) {
            // do strtotime calculations just once
            $endDate = strtotime($endDate);
            $startDate = strtotime($startDate);
    
            //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
            //We add one to inlude both dates in the interval.
            $days = ($endDate - $startDate) / 86400 + 1;
    
            $no_full_weeks = floor($days / 7);
            $no_remaining_days = fmod($days, 7);
    
            //It will return 1 if it's Monday,.. ,7 for Sunday
            $the_first_day_of_week = date("N", $startDate);
            $the_last_day_of_week = date("N", $endDate);
    
            //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
            //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
            if ($the_first_day_of_week <= $the_last_day_of_week) {
            if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
            if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
            }
    
            else {
                // (edit by Tokes to fix an edge case where the start day was a Sunday
                // and the end day was NOT a Saturday)
    
                // the day of the week for start is later than the day of the week for end
            if ($the_first_day_of_week == 7) {
                // if the start date is a Sunday, then we definitely subtract 1 day
            $no_remaining_days--;
    
            if ($the_last_day_of_week == 6) {
                // if the end date is a Saturday, then we subtract another day
                $no_remaining_days--;
            }
            }
            else {
            // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
            // so we skip an entire weekend and subtract 2 days
                $no_remaining_days -= 2;
                }
            }
        
            //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
            //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
                $workingDays = $no_full_weeks * 5;
                if ($no_remaining_days > 0 )
            {
                $workingDays += $no_remaining_days;
            }
    
            //We subtract the holidays
                foreach($holidays as $holiday){
                $time_stamp=strtotime($holiday);
            //If the holiday doesn't fall in weekend
                if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
            $workingDays--;
            }
    
                return $workingDays;
            }

            $liburan = Holidays::select('tanggal_libur')->get();
            $x = $liburan->implode('tanggal_libur',',');
            $l = explode(',',$x);
                        
            $tanggal_awal = $request->tanggal_terima;
            if ($request->tanggal_selesai == null){
                $hari_ini = now();}
            else $hari_ini = $request->tanggal_selesai;
            $holidays = $l;
                        
            $tat_aktual = round(getWorkingDay($tanggal_awal,$hari_ini,$holidays));

            if(is_numeric($request->users_id1) == false){
                $users_id1 = ($request->users_id1);
            } else $users_id1 = User::where('id',$request->users_id1)->first()->name;
        
        $this->validate($request,[
            'nama_debitur'=>'required|min:3',
            'jumlah_objek'=> 'required|numeric',
            'keterangan'=> 'required',
            'nama_debitur'=>'required',
            'nosuratbu' => 'required',
            'tujuan' => 'required',
            'tanggal_suratbu'=>'required',
            
        ]);
        $internal->update([
            'nama_debitur'=>$request->nama_debitur,
            'nosuratbu' => $request->nosuratbu,
            'tujuan' => $request->tujuan,
            'jumlah_objek'=>$request->jumlah_objek,
            'tanggal_suratbu'=>$request->tanggal_suratbu,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'tanggal_terima'=>$request->tanggal_terima,
            'bus_id' =>$request->bus_id,
            'users_id' =>$request->users_id,
            'users_id1' =>$users_id1,
            'status' => $request->status,
            'tat_aktual' => $request->$tat_aktual,
            'keterangan'=>$request->keterangan,
            'cif' => $request->cif,
        ]);

        return redirect()->route('admin.internal.index')
        ->with('success',' Data Load Penilaian Internal berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Internal $internal)
    {
        $internal->delete();

       return redirect()->route('admin.internal.index')
        ->with('danger',' Data Load Penilaian Internal sudah dihapus');
    }
}

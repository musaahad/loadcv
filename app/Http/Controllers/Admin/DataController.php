<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kjpp;
use Illuminate\Http\Request;
use App\Bus;
use App\User;
use App\Developer;
use App\Flpps;
use App\Internal;
use App\Kerjareview;
use App\Kjpps;
use App\Vercall;
use App\Reviews;
use App\Holidays;


class DataController extends Controller
{
    
    
    public function kjpps()
    {
        $kjpps = Kjpps::orderBy('name','ASC');

        return datatables()->of($kjpps)
                    ->addColumn('action','admin.kjpps.action')
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->toJson();
    }
    public function bus()
    {
        $bus = Bus::orderBy('name','ASC');

        return datatables()->of($bus)
                    ->addColumn('action','admin.bus.action')
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->toJson();
    }
        
    public function users()
    {
        $users = User::orderBy('name','ASC');

        return datatables()->of($users)
                    ->addColumn('action','admin.users.action')
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->toJson();
    }

    public function holidays()
    {
        $holi = Holidays::orderBy('tanggal_libur','DESC');

        return datatables()->of($holi)
                    ->addColumn('tanggal_libur',function(Holidays $model){
                        return date('d M Y',strtotime($model->tanggal_libur));
                    })
                    ->addColumn('action','admin.holidays.action')
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->toJson();
    }
   
    public function reviews()
    {
        
        $reviews = Reviews::with('users', 'kjpps', 'bus')->orderBy('tanggal_selesai','ASC');
        
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
       


        return datatables()->of($reviews)
                    ->addColumn('kjpp',function(Reviews $model){
                        return $model->kjpps->name;  
                    })
                    ->addColumn('BU',function(Reviews $model){
                        return $model->bus->name;
                    })
                    ->addColumn('Target TaT',function(Reviews $model){
                        
                        $bu_id = $model->bus->id;
                        if($bu_id == 13 || $bu_id == 15){
                            $tar_tat = 3;
                        }
                        if($bu_id == 12 || $bu_id == 21){
                            $tar_tat = 2;
                        }
                        if($bu_id == 17 ){
                            $tar_tat = 4;
                        }
                        if($bu_id == 19 ){
                            $tar_tat = 5;
                        }
                        if($bu_id == 18 ){
                            $tar_tat = 8;
                        }
                        
                        return $tar_tat;
                    })
                    ->addColumn('PIC',function(Reviews $model){
                        return $model->users->name;
                    })
                    ->addColumn('Tujuan Penilaian',function(Reviews $model){
                        return $model->tujuan;
                    })
                    ->addColumn('tanggal_terima',function(Reviews $model){
                        
                        return date('d M Y',strtotime($model->tanggal_terima));
                    })
                    ->addColumn('tanggal_selesai',function(Reviews $model){
                        if(($model->tanggal_selesai) != null){
                            return date('d M Y',strtotime($model->tanggal_selesai));
                        }
                        return null;
                    })
                  
                    ->addColumn('TaT Aktual',function(Reviews $model){
                        
                        $liburan = Holidays::select('tanggal_libur')->get();
                        $x = $liburan->implode('tanggal_libur',',');
                        $l = explode(',',$x);
                        
                        $tanggal_awal = $model->tanggal_terima;
                        if ($model->tanggal_selesai == null)
                            $hari_ini = now();
                        else 
                            $hari_ini = $model->tanggal_selesai;
                        $holidays = $l;
                        
                        $tat_aktual = round(getWorkingDays($tanggal_awal,$hari_ini,$holidays));
                        return $tat_aktual;
                    })
                    ->addColumn('Sisa TaT',function(Reviews $model){
                        $tanggal_awal = $model->tanggal_terima;
                        $liburan = Holidays::select('tanggal_libur')->get();
                        $x = $liburan->implode('tanggal_libur',',');
                        $l = explode(',',$x);

                        $holidays = $l;
                        
                        $bu_id = $model->bus->id;

                        if($bu_id == 13 || $bu_id == 15){
                            $tar_tat = 3;
                        }
                        if($bu_id == 12 || $bu_id == 21){
                            $tar_tat = 2;
                        }
                        if($bu_id == 17 ){
                            $tar_tat = 4;
                        }
                        if($bu_id == 19 ){
                            $tar_tat = 5;
                        }
                        if($bu_id == 18 ){
                            $tar_tat = 8;
                        }


                        if ($model->tanggal_selesai == null)
                            $harikerja = getWorkingDays($tanggal_awal,now(),$holidays);
                        else
                            $harikerja = getWorkingDays($tanggal_awal,($model->tanggal_selesai),$holidays);
                       
                        return round($tar_tat - $harikerja);
                    })

                    ->addColumn('action','admin.reviews.action')
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->toJson();
    }
    public function developer()
    {
        $developers = Developer::orderBy('name','ASC');

        return datatables()->of($developers)
                    ->addColumn('action','admin.developer.action')
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->toJson();
    }
    public function internal()
    {
        $internals = Internal::with('users', 'bus')->orderBy('tanggal_selesai','ASC');
        //$internals = Internal::orderBy('tanggal_selesai', 'ASC')->get();
        
       
        function getWorkingDays1($startDate,$endDate,$holidays) {
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
        
            return datatables()->of($internals)
                        ->addColumn('BU',function(internal $model){
                            return $model->bus->name;
                        })
                        ->addColumn('Target TaT',function(Internal $model){
                        
                            $bu_id = $model->bus->id;
                            if($bu_id == 13 || $bu_id == 15){
                                $tar_tat = 5;
                            }
                            elseif($bu_id == 17 ){
                                $tar_tat = 13;
                            }
                            elseif($bu_id == 11 ){
                                $tar_tat = 10;
                            } else $tar_tat = 0;
                            
                            
                            return $tar_tat;
                        })
                        ->addColumn('PIC',function(Internal $model){
                            return $model->users->name;
                        })
                        
                        ->addColumn('Tujuan Penilaian',function(Internal $model){
                            return $model->tujuan;
                        })
                        ->addColumn('tanggal_terima',function(Internal $model){
                            
                            return date('d M Y',strtotime($model->tanggal_terima));
                        })
                        ->addColumn('tanggal_selesai',function(Internal $model){
                            if(($model->tanggal_selesai) != null){
                                return date('d M Y',strtotime($model->tanggal_selesai));
                            }
                            return null;
                        })
                    
                        ->addColumn('TaT Aktual',function(Internal $model){
                            
                            $liburan = Holidays::select('tanggal_libur')->get();
                            $x = $liburan->implode('tanggal_libur',',');
                            $l = explode(',',$x);
                            
                            $tanggal_awal = $model->tanggal_terima;
                            if ($model->tanggal_selesai == null)
                                $hari_ini = now();
                            else 
                                $hari_ini = $model->tanggal_selesai;
                            $holidays = $l;
                            
                            $tat_aktual = round(getWorkingDays1($tanggal_awal,$hari_ini,$holidays));
                            return $tat_aktual;
                        })
                        ->addColumn('Sisa TaT',function(Internal $model){
                            $tanggal_awal = $model->tanggal_terima;
                            $liburan = Holidays::select('tanggal_libur')->get();
                            $x = $liburan->implode('tanggal_libur',',');
                            $l = explode(',',$x);

                            $holidays = $l;
                            
                            $bu_id = $model->bus->id;
                            if($bu_id == 13 || $bu_id == 15){
                                $tar_tat = 5;
                            }
                            elseif($bu_id == 17 ){
                                $tar_tat = 13;
                            }
                            elseif($bu_id == 11 ){
                                $tar_tat = 10;
                            } else $tar_tat = 0;


                            if ($model->tanggal_selesai == null)
                                $harikerja = getWorkingDays1($tanggal_awal,now(),$holidays);
                            else
                                $harikerja = getWorkingDays1($tanggal_awal,($model->tanggal_selesai),$holidays);
                        
                            return round($tar_tat - $harikerja);
                        })

                        ->addColumn('action','admin.internal.action')
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->toJson();
    }

    public function flpps()
    {
        
        $flpps = Flpps::orderBy('created_at','DESC');
       
        return datatables()->of($flpps)
                    
                     ->addColumn('BU',function(Flpps $model){
                         return $model->bus->name;
                     })
                      ->addColumn('developer',function(Flpps $model){
                            return $model->developers->name;                   
                        })
                     ->addColumn('PIC',function(Flpps $model){
                         return $model->users->name;
                     })
                    ->addColumn('Tanggal Terima',function(Flpps $model){
                        return $model->tanggal_terima;
                    })

                    ->addColumn('Tanggal Selesai',function(Flpps $model){
                        return $model->tanggal_selesai;
                    })
                    ->addColumn('action','admin.flpps.action')
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->toJson();
    }

    public function vercall()
    {
        
        $vercalls = Vercall::orderBy('created_at','DESC');
       
        return datatables()->of($vercalls)
                    
                    ->addColumn('BU',function(Vercall $model){
                        return $model->BU->name;
                    })
                    ->addColumn('developer',function(Vercall $model){
                        return $model->developer->name;                   
                    })
                    ->addColumn('tiering',function(Vercall $model){
                        return $model->developer->tiering;                   
                    })
                    ->addColumn('PIC',function(Vercall $model){
                        return $model->PIC->name;
                    })
                    ->addColumn('Tanggal Terima',function(Vercall $model){
                        return $model->tanggal_order;
                    })
                    ->addColumn('status',function(Vercall $model){
                        return $model->status->name;
                    })
                    ->addColumn('lokasi',function(Vercall $model){
                        return $model->lokasi->name;
                    })
                    ->addColumn('Tanggal Selesai',function(Vercall $model){
                        return $model->tanggal_selesai;
                    })
                    ->addColumn('action','admin.vercall.action')
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->toJson();
    }

    public function kerjareviews()
    {
        $kerjareviews = Kerjareview::latest();
        $reviews = Reviews::orderBy('tanggal_selesai','ASC');
        return datatables()->of($kerjareviews)
                    ->addColumn('Nama Debitur',function(Kerjareview $model){
                        return $model->reviews->nama_debitur;
                    })
                    ->addColumn('PIC',function(Kerjareview $model){
                        return $model->reviews->users->name;
                    })
                    ->addColumn('BU',function(Kerjareview $model){
                        return $model->reviews->bu->name;
                    })
                    ->addColumn('Tanggal Order',function(Kerjareview $model){
                        return $model->reviews->tanggal_order;
                    })
                    ->addColumn('Mulai Kerja',function(Kerjareview $model){
                        return $model->created_at;
                    })
                
                   
                 //->addColumn('action','admin.kerjareview.action')
                 ->addIndexColumn()
                 //->rawColumns(['action'])
                 ->toJson();
    }
}

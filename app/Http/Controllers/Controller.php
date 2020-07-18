<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\DiaDiemModel;
use App\LichTrinhModel;
use App\HanhTrinhModel;
use App\DatCocModel;
use App\JobModel;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        
        Controller::CapNhatToanBoLienQuanDenLichTrinh();
        Controller::CapNhatTableDatCoc();
    }

    public function CapNhatTableDatCoc(){
        $now = Carbon::now();

        $alldatcoc = DB::table('datcoc')->where('status','=',1)->get();

        foreach($alldatcoc as $adc){
            $datcoc = DatCocModel::find($adc->id);
            $datcoc->present = $now;
          
            if($datcoc->present >= $datcoc->endtime){
                $datcoc->status = "0";
                $customer = User::find($datcoc->customer_id);
                $customer->taikhoan -= $datcoc->total/2;
                $customer->save();

                $guide = User::find($datcoc->guide_id);
                $guide->taikhoan += $datcoc->total*1.5;
                $guide->save();
            }
            $datcoc->save();
        }
       
    }


    public function CapNhatToanBoLienQuanDenLichTrinh(){
        $now = Carbon::now();
        $allichtrinh = LichTrinhModel::all()->where('status','=',1);
        $allhanhtrinh = HanhTrinhModel::all();
        $alljob = JobModel::all()->where('status','=',0);
        $alldatcoc = DatCocModel::all()->where('status','=',1);
        
        foreach($allichtrinh as $lt){
            $lichtrinh = LichTrinhModel::find($lt->id);
            $lichtrinh->present = $now;
            
            if($lichtrinh->present >= $lichtrinh->public){
                $lichtrinh->status = "0";
                foreach($allhanhtrinh as $aht){
                    if($aht->lichtrinh_id == $lichtrinh->id){
                        foreach($alljob as $aj){
                            if($aj->hanhtrinh_id == $aht->id){
                                $job = JobModel::find($aj->id);
                                $job->delete();
                            }
                        }
                    }
                }
                foreach($alldatcoc as $dc){
                    $datcoc = DatCocModel::find($dc->id);

                    $cus = User::find($datcoc->customer_id);
                    $cus->taikhoan += $datcoc->total/2;
                    $cus->save();

                    $jobstatus1 = JobModel::all()->where('status','=',1);
                    foreach($jobstatus1 as $j1){
                        if($j1->hanhtrinh_id == $datcoc->hanhtrinh_id){
                            $job = JobModel::find($j1->id);
                            $job->delete();
                        }
                    }
                }
            }
            $lichtrinh->save();
        }
    }
}

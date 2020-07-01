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
use App\CustomerModel;
use App\GuideModel;
use App\User;
use App\TourModel;
use App\JobModel;
use App\DatCocModel;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // reset tour
    public function __construct(){

        $now = Carbon::now();
        // get toan bo tour dang public cua user va co status = 0, status = 1 -> tour die (da qua table khac)
            $tour = TourModel::all()->where('statuspublic','=',1);
            foreach ($tour as $t){
            $idtour = TourModel::find($t->id);
            $idtour->present = $now;
                if($idtour->present >= $idtour->timepublic){
                    $idtour->statuspublic = 0;

                    //xoa job toan bo job khi public => lam sach listjob cho hdv
                    $job = DB::table('jobs')->where('tour_id','=',$idtour->id)->where('status','=',0)->delete();

                    //hoan tien lai cho customer
                    $refunddatcoccustomer = CustomerModel::find($t->cus_id);
                    $cost = DB::table('datcoc')->where('guide_id','=',0)->where('cus_id','=',$t->cus_id)->get();
                    foreach($cost as $c){
                        $sumcost = $c->sumcost;
                        $refunddatcoccustomer->money = $refunddatcoccustomer->money + $sumcost;
                        $refunddatcoccustomer->save();
                        break;
                    }
                    

                    //sau khi hoantien thi xoa tour neu hdv khong dat coc.
                    $tbldatcoc = DB::table('datcoc')->where('guide_id','=',0)->where('status','=',0)->delete();
                }
            $idtour->save();
            
        }   
        
        // cap nhap present cua table datcoc
        DB::update('update datcoc set present = ? where status = 0', [$now]);
        

        //cap nhat present cua datcoc, tour kich hoat khi openline <= present <= deadline, qua dead line tour tu dong hoan thanh

        $endtour = DB::table('datcoc')->where('status','=',0)->get();
        foreach($endtour as $et){
            // cap nhat present
            if($et->present >= $et->deadline){
                
                // cong tien cho hdv 
                $findidguide = GuideModel::find($et->guide_id);
                $findidguide->money = $findidguide->money + (($et->sumcost)*1.5);
                $findidguide->point = $findidguide->point + 1;
                $findidguide->save();

                // tru tien khach hang
                $findidcustomer = CustomerModel::find($et->cus_id);
                $findidcustomer->money = $findidcustomer->money - (($et->sumcost)*0.5);
                $findidcustomer->save();

                // status = 1 -> tour da hoan thanh va tra tien
                $findiddatcoc = DatcocModel::find($et->id);
                $findiddatcoc->status = "1";
                $findiddatcoc->save();
            }
        }
    }
}

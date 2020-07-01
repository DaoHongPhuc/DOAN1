<?php

namespace App\Http\Controllers;

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


class DatcocController extends Controller
{
    public function postCustomerHuyCoc($idcoc){
        // define
        $user = Auth::user();
        $iduser = $user->id;
        $datcoc = DatcocModel::find($idcoc);
        $now = Carbon::now();

        // check date
        $nkh = Date($datcoc->openline);  
        $checkngay = $now->diffInDays($nkh)+1;

        //tim customer 
        $cus_id = $datcoc->cus_id;
        $customer = CustomerModel::find($cus_id);

        //tim guide 
        $guide_id = $datcoc->guide_id;
        $guide = GuideModel::find($guide_id);

        // tiencoc
        $tiencoc = ($datcoc->sumcost)/2;

        if($checkngay < 10){
            if($checkngay > 5){
                $customer->money = $customer->money + ($tiencoc)/2;
                $guide->money = $guide->money + ($tiencoc)/2;
                $customer->save();
                $guide->save();
                $datcoc->delete();
                return redirect('guide/setjob/'.$iduser.'')->with('thongbao','Hủy job thành công');
            }else{
                $customer->money = $customer->money + ($tiencoc)/2*0;
                $guide->money = $guide->money + ($tiencoc)/2*0;
                $customer->save();
                $guide->save();
                $datcoc->delete();
                return redirect('guide/setjob/'.$iduser.'')->with('thongbao','Hủy job thành công');
            }
        }else{
            $customer->money = $customer->money + $tiencoc;
            $guide->money = $guide->money + $tiencoc;
            $customer->save();
            $guide->save();
            $datcoc->delete();
            return redirect('guide/setjob/'.$iduser.'')->with('thongbao','Hủy job thành công');
        }
    }

    public function postGuideHuyCoc($idcoc){
        // define
        $user = Auth::user();
        $iduser = $user->id;
        $datcoc = DatcocModel::find($idcoc);
        $now = Carbon::now();

        // check date
        $nkh = Date($datcoc->openline);  
        $checkngay = $now->diffInDays($nkh)+1;

        //tim customer 
        $cus_id = $datcoc->cus_id;
        $customer = CustomerModel::find($cus_id);

        //tim guide 
        $guide_id = $datcoc->guide_id;
        $guide = GuideModel::find($guide_id);

        // tiencoc
        $tiencoc = ($datcoc->sumcost)/2;

        if($checkngay < 10){
            if($checkngay > 5){
                $customer->money = $customer->money + ($tiencoc)/2;
                $guide->money = $guide->money + ($tiencoc)/2;
                $customer->save();
                $guide->save();
                $datcoc->delete();
                return redirect('guide/setjob/'.$iduser.'')->with('thongbao','Hủy job thành công');
            }else{
                $customer->money = $customer->money + ($tiencoc)/2*0;
                $guide->money = $guide->money + ($tiencoc)/2*0;
                $customer->save();
                $guide->save();
                $datcoc->delete();
                return redirect('guide/setjob/'.$iduser.'')->with('thongbao','Hủy job thành công');
            }
        }else{
            $customer->money = $customer->money + $tiencoc;
            $guide->money = $guide->money + $tiencoc;
            $customer->save();
            $guide->save();
            $datcoc->delete();
            return redirect('guide/setjob/'.$iduser.'')->with('thongbao','Hủy job thành công');
        }
        
    }

    public function postCustomerDatCoc(Request $request, $idcus, $idtour){
        $user = Auth::user();
        $iduser = $user->id;

        $customer = CustomerModel::find($idcus);
        
        if($customer->money - $request->cost <0){
            return redirect('customer/account/'.$iduser.'')->with('thongbao','Tài khoản của bạn không đủ tiền để đặt cọc. Hãy nạp thêm !');
        
        }else{
            //tien dat coc
            $customer->money = $customer->money - $request->cost;
            $customer->save();

            // thay doi status cua tour
            $tour = TourModel::find($idtour);
            $tour->status = "1";
            $tour->save();

            // dat coc
            $datcoc = new DatCocModel;
            $datcoc->guide_id = "0";
            $datcoc->cus_id = $idcus;
            $datcoc->tour_id = $idtour;
            $datcoc->sumcost = $request->cost;
            $datcoc->openline = $request->starttime;
            $datcoc->deadline = $request->endtime;
            $datcoc->status = "0";
            $datcoc->save();

            return redirect('customer/listtour/'.$iduser.'')->with('thongbao','Đặt cọc thành công ! Nếu hướng dẫn viên đặt cọc, tour sẽ hiển thị trong ĐẶT CỌC.');
        }
        
    }
    public function postGuideDatCoc(Request $request,$idguide, $idjob, $iddatcoc){
        $user = Auth::user();
        $iduser = $user->id;

        $guide = GuideModel::find($idguide);

        if($guide->money - $request->cost < 0){
            return redirect('guide/account/'.$iduser.'')->with('thongbao','Tài khoản của bạn không đủ tiền để đặt cọc. Hãy nạp thêm !');
        }else{
            //tien dat coc
            $guide->money = $guide->money - $request->cost;
            $guide->save();

            // thay doi status cua job
            $job = JobModel::find($idjob);
            $job->status = "1";
            $job->save();

            // dat coc
            $datcoc = DatCocModel::find($iddatcoc);
            $datcoc->guide_id = $idguide;
            $datcoc->sumcost = $datcoc->sumcost + $request->cost;
            $datcoc->save();
    
            return redirect('guide/listjob/'.$iduser.'')->with('thongbao','Đặt cọc thành công ! Truy cập ĐẶT CỌC để xem.');
        }
    }
}

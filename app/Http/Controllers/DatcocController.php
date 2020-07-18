<?php

namespace App\Http\Controllers;

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
use App\ThongBaoModel;

class DatCocController extends Controller
{
    public function postThongBao($iduser, $money){
        $thongbao = new ThongBaoModel;
        $thongbao->user_id = $iduser;
        $thongbao->noidung = 'Bạn đã nhận được số tiền là: $'.$money;
        $thongbao->status = "0";

        $thongbao->save();
    }
    public function postHuy1HTDC(Request $request, $iddc, $idhdv, $idkh){
   
        $datcoc = DatCocModel::find($iddc);
        $total = $datcoc->total;
        $idhanhtrinh = $datcoc->hanhtrinh_id;

        $hdv = User::find($idhdv);
        $hdv->taikhoan += $total * $request->heso;
        DatCocController::postThongBao($idhdv,$total * $request->heso);
        $hdv->save();

        $cus = User::find($idkh);
        $cus->taikhoan += $total * $request->heso;
        DatCocController::postThongBao($idkh,$total * $request->heso);
        $cus->save();

        DB::table('job')->where('user_id','=',$hdv->id)->where('hanhtrinh_id','=',$idhanhtrinh)->delete();

        $datcoc->delete();

        return redirect()->back()->with('thongbao','Đã hủy hành trình và hoàn cọc');
    }

    public function postHuyAHTDC(Request $request, $idlt){
        if(Auth::check()){
            $user = Auth::user();
            $idcus = $user->id;
        }

        $datcoc = DB::table('datcoc')->where('lichtrinh_id','=',$idlt)->get();

        $arrayGuide = array();
        $arrayPresent = array();
        $arrayStarttime = array();
        $arrayTotal = array();
        foreach($datcoc as $dc){
            $arrayTotal[] = $dc->total;
        }
        foreach($datcoc as $dc){
            $arrayGuide[] = $dc->guide_id;
        }
        foreach($datcoc as $dc){
            $arrayPresent[] = $dc->present;
        }
        foreach($datcoc as $dc){
            $arrayStarttime[] = $dc->starttime;
        }
        for($i = 0; $i < count($datcoc); $i++){
            if(strtotime($arrayStarttime[$i]) - strtotime($arrayPresent[$i]) >= 864000){
                $guide = User::find($arrayGuide[$i]);
                $cus = User::find($idcus);

                $guide->taikhoan += $arrayTotal[$i]/2;
                DatCocController::postThongBao($arrayGuide[$i],$arrayTotal[$i]/2);

                $cus->taikhoan += $arrayTotal[$i]/2;
                DatCocController::postThongBao($idcus,$arrayTotal[$i]/2);
                
                $guide->save();
                $cus->save();
            }elseif(strtotime($arrayStarttime[$i]) - strtotime($arrayPresent[$i]) <= 432000){
                $guide = User::find($arrayGuide[$i]);
                $cus = User::find($idcus);

                $guide->taikhoan += $arrayTotal[$i] * 0;
                DatCocController::postThongBao($arrayGuide[$i],$arrayTotal[$i] * 0);

                $cus->taikhoan += $arrayTotal[$i] * 0;
                DatCocController::postThongBao($idcus,$arrayTotal[$i] * 0);
                
                $guide->save();
                $cus->save();
                
            }else{
                $guide = User::find($arrayGuide[$i]);
                $cus = User::find($idcus);

                $guide->taikhoan += $arrayTotal[$i]/4;
                DatCocController::postThongBao($arrayGuide[$i],$arrayTotal[$i]/4);

                $cus->taikhoan += $arrayTotal[$i]/4;
                DatCocController::postThongBao($idcus,$arrayTotal[$i]/4);

                $guide->save();
                $cus->save();
            }
        }

        DB::table('job')->where('lichtrinh_id','=',$idlt)->delete();
        DB::table('datcoc')->where('lichtrinh_id','=',$idlt)->delete();

        return redirect()->back()->with('thongbao','Đã hủy toàn bộ hành trình đã đặt cọc trong lịch trình và hoàn cọc');
        
    }
    
    public function postHDVDC(Request $request, $iddc, $idhdv){       
        return redirect()->back()->with('thongbao','Đã đặt cọc');

    }

    public function getNguoiNhanHanhTrinh($idht){
        $danhsachnguoinhan = DB::table('job')->where('hanhtrinh_id','=',$idht)->get();
        $hanhtrinh = HanhTrinhModel::find($idht);
        $diadiem = DiaDiemModel::all();
        $user = User::all();

        $datcoc = DB::table('datcoc')->where('hanhtrinh_id','=',$hanhtrinh->id)->get();
        return view('pages.customer.lichtrinh.listnguoinhan',[
            'datcoc'=>$datcoc,
            'hanhtrinh'=>$hanhtrinh,
            'danhsachnguoinhan'=>$danhsachnguoinhan,
            'diadiem'=>$diadiem,
            'user'=>$user,
            ]);

    }

    public function postNhanHDV(Request $request, $idj, $idhdv, $idht){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }

        // kiểm tra chỉ đặt cọc được 1 người
        $check = true;
        $datcoc = DB::table('datcoc')->where('customer_id','=',$iduser)->get();
        $now = Carbon::now();
        $hanhtrinh = HanhTrinhModel::find($idht);
        $lichtrinh = LichTrinhModel::find($hanhtrinh->lichtrinh_id);
        foreach($datcoc as $dc){
            if($dc->hanhtrinh_id == $idht){
                $check = false;
            }
        }

        if($check){
            $datcoc = new DatCocModel;
            $datcoc->hanhtrinh_id = $idht;
            $datcoc->guide_id = $idhdv;
            $datcoc->customer_id = $iduser;
            $datcoc->starttime = $request->starttime;
            $datcoc->endtime = $request->endtime;
            $datcoc->total = $request->total;
            $datcoc->present = $now;
            $datcoc->status = "1";
            $datcoc->lichtrinh_id = $lichtrinh->id;
    
            $job = JobModel::find($idj);
            $job->status = "1";

            $user = User::find($iduser);
            if($user->taikhoan - $request->total/2 < 0){
                return redirect()->back()->with('thongbao','Không đủ tiền đặt cọc');
            }
            else{
                $user->taikhoan -= $request->total/2;
                $user->save();
                $hdv = User::find($idhdv);

                $hdv->taikhoan -= $request->total/2;
                $hdv->save();
            }
    
            $job->save();
            $datcoc->save();
            return redirect()->back()->with('thongbao','Đã đặt cọc');
        }else{
            return redirect()->back()->with('thongbao','Bạn đã đặt cọc hành trình này rồi');

        }

     
    }
}

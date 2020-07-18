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
use App\JobModel;
use App\DatCocModel;

class GuideController extends Controller
{
    public function postHDVHuy($idht){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }
        $datcoc = DB::table('job')->where('hanhtrinh_id','=',$idht)->where('user_id','=',$iduser)->delete();

        return redirect()->back()->with('thongbao','Hủy thành công');
    }
    public function getDanhSachJob(){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }
        $hanhtrinh = HanhTrinhModel::all();
        $diadiem = DiaDiemModel::all();

        $job = DB::table('job')->where('user_id','=',$iduser)->get();
        $datcoc = DB::table('datcoc')->where('guide_id','=',$iduser)->get();
        return view('pages.guide.job.list',[
            'datcoc'=>$datcoc,
            'job'=>$job,
            'diadiem'=>$diadiem,
            'hanhtrinh'=>$hanhtrinh,
            ]);
    }
    public function getNhanHanhTrinh($idlt, $idht){
        

        $allhanhtrinh = HanhTrinhModel::all()->where('lichtrinh_id','=',$idlt);
        $hanhtrinh = HanhTrinhModel::find($idht);
        $lichtrinh = LichTrinhModel::find($idlt);
        $diadiem = DiaDiemModel::all();

        return view('pages.nhanhanhtrinh',[
            'lichtrinh'=>$lichtrinh,
            
            'diadiem'=>$diadiem,
            'allhanhtrinh'=>$allhanhtrinh,
            'hanhtrinh'=>$hanhtrinh]);
    }

    public function postNhanHanhTrinh(Request $request, $idht){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }
        $checktrungngaykhachlichtrinh = true;

        $jobtrungngaykhaclichtrinh = DB::table('job')->where('user_id','=',$iduser)->get();

        foreach($jobtrungngaykhaclichtrinh as $jtnklt){
            if($jtnklt->ngaykhoihanh == $request->ngaykhoihanh){
                $checktrungngaykhachlichtrinh = false;
            }
        }

        if($checktrungngaykhachlichtrinh){
            $checktaikhoan = true;

            if($user->taikhoan < ($request->endtime - $request->starttime)*$request->price/2){
                $checktaikhoan = false;
            }
            
            if($checktaikhoan){
                $lichtrinh = LichTrinhModel::find($request->idlichtrinh);
                $hanhtrinh = HanhTrinhModel::find($idht);
                $job1 = DB::table('job')->where('user_id','=',$iduser)->get();
                $check1ht = true;
                foreach($job1 as $j1){
                if($j1->lichtrinh_id == $request->idlichtrinh ){
                        $check1ht = false;
                        
                    }
                }

                if($check1ht){
                    $job = DB::table('job')->where('user_id','=',$iduser)->get();
                    $check = true;
                    foreach($job as $j){
                        if($j->hanhtrinh_id == $idht){
                            if($j->ngaykhoihanh == $request->ngaykhoihanh && $j->user_id == $iduser){
                                // false là đc nhận 1 lịch trình, true là nhận ko giới hạn.
                                $check = false;
                            }
                        }
                    }
                    if($check == true){
                        if($hanhtrinh->lichtrinh->status == 1){
                            if($hanhtrinh->lichtrinh->public >= $hanhtrinh->lichtrinh->present){     
                                $job = new JobModel;
                                $job->hanhtrinh_id = $idht;
                                $job->user_id = $iduser;
                                $job->temp_starttime = $request->starttime;
                                $job->temp_endtime = $request->endtime;
                                $job->price = $request->price;
                                $job->ngaykhoihanh = $request->ngaykhoihanh;
                                $job->starttime = Date(''.$request->ngaykhoihanh.' '.$request->starttime.':00:00');;
                                $job->endtime = Date(''.$request->ngaykhoihanh.' '.$request->endtime.':00:00');  ;
                                $job->status = "0";
                                $job->lichtrinh_id = $lichtrinh->id;
                                $job->save();
            
                                return redirect()->back()->with('thongbao','Nhận Hành Trình Thành Công !');
                            }else{
                                return redirect()->back()->with('thongbao','Không thành công ! Hành trình đã có người nhận hoặc hết thời hạn');
                            }
                        }else{
                            return redirect()->back()->with('thongbao','Không thành công ! Hành trình đã có người nhận hoặc hết thời hạn');
                        }
                    }else{
                        return redirect()->back()->with('thongbao','Không thành công ! Hành trình đã nhận hoặc trùng lịch, hãy kiểm tra lại');
                    }
                }else{
                    return redirect()->back()->with('thongbao','Bạn chỉ được nhận 1 hành trình trong lịch trình này');
        
                }
            
                
            }else{
                return redirect()->back()->with('thongbao','Không đủ tài khoản để nhận hành trình !');

            }
            
        }else{
            return redirect()->back()->with('thongbao','Đã trùng ngày khởi hành của lịch trình khách!');
            
        }
        
        
      
    }

    
}

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

class CustomerController extends Controller
{
    public function postXoaHanhTrinh($idht){
        $hanhtrinh = HanhTrinhModel::find($idht);

        $hanhtrinh->delete();
        return redirect()->back()->with('thongbao','Xóa thành công.');
    }

    public function postCongBoLichTrinh($idlt){
        $now = Carbon::now();
        $lichtrinh = LichTrinhModel::find($idlt);
        if($lichtrinh->status == 0){
            $lichtrinh->status = 1;
            $lichtrinh->present = $now;    
            $lichtrinh->public = $now->addHours(1);    

            $lichtrinh->save();
            return redirect()->back()->with('thongbao','Lịch trình sẽ công bố trong 1h');
        }else{
            // huy all job.
            $tatcahanhtrinhtronglichtrinh = DB::table('hanhtrinh')->where('lichtrinh_id','=',$idlt)->get();
            foreach($tatcahanhtrinhtronglichtrinh as $tclt){
                $job = DB::table('job')->where('hanhtrinh_id','=',$tclt->id)->where('status','=',0)->delete();
            }
            // chuyen trang thai.
            $lichtrinh->status = 0;    
            $lichtrinh->save();
            return redirect()->back()->with('thongbao','Lịch trình đã ẩn');
        }
        
    }

    // public function postHuyAllHanhTrinh($idlt){
    //     $hanhtrinh = DB::table('hanhtrinh')->where('lichtrinh_id','=',$idlt)->delete();

    //     return redirect()->back()->with('thongbao','Hủy thành công');
    // }

    public function postAddHanhTrinh(Request $request, $idlt){
        $this->validate($request,
        [
            'diadiem'=>'required',
            'ngaykhoihanh'=>'required',
        ],
        [
            'diadiem.required'=>'Chưa nhập Địa Điểm Hành Trình',
            'ngaykhoihanh.required'=>'Chưa nhập Ngày Khởi Hành',
        ]);
     

        $now = Carbon::now();
        
        $result = strtotime($request->ngaykhoihanh) - strtotime($now);
        if($result > 864000){
            $hanhtrinh = new HanhTrinhModel;
        
            $hanhtrinh->diadiem_id = $request->diadiem;
            $hanhtrinh->lichtrinh_id = $idlt;
            $hanhtrinh->ngaykhoihanh = $request->ngaykhoihanh;

            $hanhtrinh->save();
            return redirect()->back()->with('thongbao','Thêm Hành Trình Thành Công');
        }else{
            return redirect()->back()->with('thongbao','Hành trình được lên sau 10 ngày kể từ bây giờ');
        }
        
    }

    public function getAddHanhTrinh($idlt){

        $diadiem = DiaDiemModel::all();
        $lichtrinh = LichTrinhModel::find($idlt);
        $hanhtrinh = DB::table('hanhtrinh')->where('lichtrinh_id','=',$idlt)->orderBy('ngaykhoihanh','asc')->get();

        return view('pages.customer.lichtrinh.addhanhtrinh',[
            'hanhtrinh'=>$hanhtrinh,
            'diadiem'=>$diadiem,
            'lichtrinh'=>$lichtrinh]);
    }

    public function getSettingLichTrinh($idlt){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }
        $diadiem = DiaDiemModel::all();
        $hanhtrinh = DB::table('hanhtrinh')->where('lichtrinh_id','=',$idlt)->get();
        $lichtrinh = LichTrinhModel::find($idlt);
        $datcoc = DB::table('datcoc')->where('customer_id','=',$iduser)->get();
        $user = User::all()->where('level','=',2);
        $job = DB::table('job')->where('lichtrinh_id','=',$idlt)->get();
        return view('pages.customer.lichtrinh.thietlap',[
            'job'=>$job,
            'user'=>$user,
            'datcoc'=>$datcoc,
            'diadiem'=>$diadiem,
            'hanhtrinh'=>$hanhtrinh,
            'lichtrinh'=>$lichtrinh]);
    }

    public function getListLichTrinh(){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }
        $lichtrinh = DB::table('lichtrinh')->where('user_id','=',$iduser)->get();
        $hanhtrinh = DB::table('hanhtrinh')->get();

        return view('pages.customer.lichtrinh.list',[
            'lichtrinh'=>$lichtrinh,
            'hanhtrinh'=>$hanhtrinh,
            ]);
    }

    public function getAddLichTrinh(){
        return view('pages.customer.lichtrinh.add');
    }

    public function postAddLichTrinh(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }

        $this->validate($request,
        [
            'name'=>'required',
        ],
        [
            'name.required'=>'Chưa nhập Tên Lịch Trinh',
        ]);
        $now = Carbon::now();
        $lichtrinh = new LichTrinhModel;
            
        $lichtrinh->name = $request->name;
        $lichtrinh->user_id = $iduser;

        $lichtrinh->status = "0";
        $lichtrinh->present = $now;
        $lichtrinh->public = $now;

        $lichtrinh->save();
        return redirect()->back()->with('thongbao','Thêm Lịch Trình Thành Công');
        
    }

    

    
}

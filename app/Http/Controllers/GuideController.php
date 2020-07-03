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
use App\BinhluanModel;

class GuideController extends Controller
{
    public function getDetailJob($idjob){
        $job = JobModel::find($idjob);

        return response()->json(['job'=>$job]);
    }

    public function getHome(){
        return view('pages.guide.index');
    }

    public function postAddJob(Request $request,$idtour){
        $user = Auth::user();
        $tour = TourModel::find($idtour);
        $alljob = DB::table('jobs')->where('status','=',0)->get();
        $flask = true;
        foreach($alljob as $aj){
            if($aj->tour_id == $idtour){
                if($aj->ngaykhoihanh == $request->ngaykhoihanh && $aj->guide_id == $user->guide->id){
                    $flask = false;
                }
            }
        }

        if($flask == true){
            if($tour->status == 0){
                if($tour->endtime <= $tour->present){     
                    $this->validate($request,
                    [
                        'starttime'=>'required',
                        'endtime'=>'required',
                    ],
                    [
                        'starttime.required'=>'Bạn chưa nhập Thời Gian Bắt Đầu',
                        'endtime.required'=>'Bạn chưa nhập Thời Gian Kết Thúc',
                    ]);
    
                    $job = new JobModel;
                    $job->guide_id = $user->guide->id;
                    $job->tour_id = $idtour;
    
                    $job->price = $request->price;
                    $job->temp_starttime = $request->starttime;
                    $job->temp_endtime = $request->endtime;
                    $job->starttime = Date(''.$request->ngaykhoihanh.' '.$request->starttime.':00:00');   
                    $job->endtime = Date(''.$request->ngaykhoihanh.' '.$request->endtime.':00:00');   
                    $job->ngaykhoihanh = $request->ngaykhoihanh;
                    $job->status = "0";
    
                    $job->save();
                    return redirect()->back()->with('thongbao','Nhận tour thành công, Vào danh sách tour để xem ngay !');
                }else{
                    return redirect()->back()->with('thongbao','Không thành công ! Tour đã có người nhận hoặc hết thời hạn');
                }
            }else{
                return redirect()->back()->with('thongbao','Không thành công ! Tour đã có người nhận hoặc hết thời hạn');
            }
        }else{
            return redirect()->back()->with('thongbao','Không thành công ! Tour đã nhận hoặc trùng lịch, hãy kiểm tra lại');
        }
        
    }

    public function getListJob($iduser){
        $user = User::find($iduser);
        $job = DB::table('jobs')->where('guide_id','=',$user->guide->id)
        ->where('status','=',0)
        ->orderBy('created_at','desc')->get();
        $tour = DB::table('tours')->where('status','=',1)->orderBy('updated_at','desc')->get();
        $tabledatcoc = DB::table('datcoc')->where('status','=',0)->orderBy('openline','desc')->get();

        return view('pages.guide.job.list',['user'=>$user,'job'=>$job,'tour'=>$tour,'tabledatcoc'=>$tabledatcoc]);
    }

    public function getSetJob($iduser){
        $user = User::find($iduser);
        $idguide = $user->guide->id;

        $datcoc = DB::table('datcoc')->where('guide_id','=',$idguide)->where('guide_id','!=',0)->orderBy('deadline','desc')->get();
        $tour = DB::table('tours')->orderBy('updated_at','desc')->get();

        
        return view('pages.guide.job.set',['tour'=>$tour,'user'=>$user,'datcoc'=>$datcoc]);
    }

    public function getScheduleJob($iduser){
        $user = User::find($iduser);
        
        return view('pages.guide.job.schedule',['user'=>$user]);
    }

    public function getHistory($iduser){
        $user = User::find($iduser);
        
        return view('pages.guide.job.history',['user'=>$user]);
    }

    public function getInformation($iduser){
        $user = User::find($iduser);
        $idgui = $user->guide->id;
        $binhluan = DB::table('binhluan')->where('guide_id','=',$idgui)->orderBy('created_at','desc')->get();

        $customer = CustomerModel::all();
        
        return view('pages.guide.profile.information',['customer'=>$customer,
        'binhluan'=>$binhluan,
        'user'=>$user]);
    }

    public function getAccount($iduser){
        $user = User::find($iduser);
        
        return view('pages.guide.profile.account',['user'=>$user]);
    }

    public function getEditInformation($iduser,$idg){
        $user = User::find($iduser);
        $guide = GuideModel::find($idg);

        return view('pages.guide.profile.editinfor',['user'=>$user,'guide'=>$guide]);
    }

    public function postEditInformation(Request $request,$iduser, $idg){
        $this->validate($request,
        [
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            // 'image'=>'required',
            'local'=>'required',
            'detaillocal'=>'required',
            'desself'=>'required',
            'deslocal'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập Họ và Tên',
            'address.required'=>'Bạn chưa nhập Địa Chỉ',
            'phone.required'=>'Bạn chưa nhập Số Điện Thoại',
            'gender.required'=>'Bạn chưa nhập Giới Tính',
            // 'image.required'=>'Bạn chưa nhập Ảnh Đại Diện',
            'local.required'=>'Bạn chưa nhập Địa Điểm',
            'detaillocal.required'=>'Bạn chưa nhập Lịch Trinh',
            'desself.required'=>'Bạn chưa nhập Mô Tả Bản Thân',
            'deslocal.required'=>'Bạn chưa nhập Sơ Lược Về Lịch Trình',
        ]);

        $guide = GuideModel::find($idg);
        
        $guide->name = $request->name;
        $guide->address = $request->address;
        $guide->gender = $request->gender;
        $guide->phone = $request->phone;

        if($request->hasFile('image')){

            $hinhanh = $request->image;
            $name = $hinhanh->getClientOriginalName();

            $hinhanh->move('./upload/traveller',$name);
            $guide->image = $name;
        }

        $guide->local = $request->local;
        $guide->detaillocal = $request->detaillocal;
        $guide->desself = $request->desself;
        $guide->deslocal = $request->deslocal;

        $guide->save();
        return redirect()->back()->with('thongbao','Cập nhật thông tin cá nhân thành công');
    }

    public function postAddMoney(Request $request, $iduser, $idg){
        $user = User::find($iduser);

        $this->validate($request,
        [
            'money'=>'required',
        ],
        [
            'money.required'=>'Nhập số tiền muốn nạp',
        ]);
        
        $guide = GuideModel::find($idg);
        $guide->money = $guide->money + $request->money;

        $guide->save();
        return redirect()->back()->with('thongbao','Nạp tài khoản thành công');
    }


    public function getNotification($iduser){
        $user = User::find($iduser);
        
        return view('pages.guide.profile.notification',['user'=>$user]);
    }
    
    public function getSetting($iduser){
        $user = User::find($iduser);
        
        return view('pages.guide.profile.setting',['user'=>$user]);
    }

    public function postEditJob(Request $request, $idjob){
        $job = JobModel::find($idjob);

        $job->price = $request->price;
        $job->temp_starttime = $request->starttime;
        $job->temp_endtime = $request->endtime;
        $job->starttime = Date(''.$request->ngaykhoihanh.' '.$request->starttime.':00:00');   
        $job->endtime = Date(''.$request->ngaykhoihanh.' '.$request->endtime.':00:00');   

        $job->save();
        return redirect()->back()->with('thongbao','Cập nhật job thành công');

    }
    
    public function postHuyTour($idjob){
        $job = JobModel::find($idjob);

        $job->delete();
        return redirect()->back()->with('thongbao','Hủy job thành công');
    }
}

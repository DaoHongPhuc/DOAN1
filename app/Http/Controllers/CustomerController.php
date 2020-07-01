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
use App\BinhluanModel;
use App\JobModel;
use App\ReportModel;
use App\DatCocModel;


class CustomerController extends Controller
{
    public function postEndTour($iddatcoc, $idcus, $idguide){
        $datcoc = DatcocModel::find($iddatcoc);

        $datcoc->status = 1;
        $datcoc->save();

        $datcoc->present = $datcoc->deadline;
        $datcoc->save();

        $customer = CustomerModel::find($idcus);
        $customer->taikhoan = $customer->taikhoan + $dc->sumcost*1.5;
        $customer->save();

        $guide = GuideModel::find($idguide);
        $guide->taikhoan = $guide->taikhoan - $dc->sumcost*0.5;
        $guide->point = $guide->point + 1;
        $guide->save();

        return redirect()->back()->with('thongbao','Kết thúc tour thành công !');
    }

    public function postReport(Request $request, $idcus, $idguide, $idtour){
        $this->validate($request,
        [
            'noidung'=>'required',
        ],
        [
            'noidung.required'=>'Hãy nhập lý do báo cáo',
        ]);

        $report = new ReportModel;
        $report->guide_id = $idguide;
        $report->cus_id = $idcus;
        $report->tour_id = $idtour;
        $report->noidung = $request->noidung;
        $report->status = "0";

        $report->save();
        return redirect()->back()->with('thongbao','Báo cáo tour thành công !');
    }

    public function postEditTour(Request $request,$idtour){
        $this->validate($request,
        [
            'diadiem'=>'required',
            'ngaykhoihanh'=>'required',
            'note'=>'required',
        ],
        [
            'diadiem.required'=>'Bạn chưa nhập Địa Điểm',
            'ngaykhoihanh.required'=>'Bạn chưa Ngày Khởi Hành',
            'note.required'=>'Bạn chưa nhập Lưu ý',
        ]);

        $tour = TourModel::find($idtour);

        $tour->diadiem = $request->diadiem;
        $tour->ngaykhoihanh = $request->ngaykhoihanh;
        $tour->note = $request->note;

        $tour->save();
        return redirect()->back()->with('thongbao','Cập nhật tour thành công !');
    }

    
    public function postComment(Request $request, $idcus, $idguide){
        $binhluan = new BinhluanModel;

        $binhluan->cus_id = $idcus;
        $binhluan->guide_id = $idguide;
        $binhluan->noidung = $request->noidung;

        $binhluan->save();
        return redirect()->back()->with('thongbao','Bình luận thành công');
    }
    
    public function getViewGuideApply($iduser, $idtour){
        $user = User::find($iduser);
        $idcus = $user->customer->id;
        
        $guide = GuideModel::all();
        $job = DB::table('jobs')->where('status','=',0)->where('tour_id','=',$idtour)->get();
        $tour = DB::table('tours')->where('cus_id','=',$idcus)->where('status','=',0)->orderBy('created_at','desc')->get();
        $binhluan = DB::table('binhluan')->orderBy('created_at','desc')->get();
        $customer = CustomerModel::all();
    
        //tim customer binh luan

        return view('pages.customer.tour.guideapply',['binhluan'=>$binhluan,
        'customer'=>$customer,
        'user'=>$user,
        'tour'=>$tour,
        'job'=>$job,
        'guide'=>$guide]);
    }

    public function postPublicTour($idtour){
        $now = Carbon::now();
        $tour = TourModel::find($idtour);
        if($tour->statuspublic == 0){
            $tour->timepublic = $now->addHours(1);
            $tour->statuspublic = 1;
            $tour->save();

            return redirect()->back()->with('thongbao','Hướng dẫn viên sẽ nhận tour trong vòng 1h kể từ khi được công bố');

        }else{
            $job = DB::table('jobs')->where('tour_id','=',$idtour)->where('status','=',0)->get();
            foreach($job as $j){
                $idjob = $j->id;
                $findjob = JobModel::find($idjob);
                $findjob->delete();
            }
            $tour->statuspublic = 0;
            $tour->save();

            return redirect()->back()->with('thongbao','Tour đã chuyển về trạng thái ẩn.');

        }
    }
    public function postAddTour(Request $request, $idcus){
        $this->validate($request,
        [
            'diadiem'=>'required',
            'ngaykhoihanh'=>'required',
            'note'=>'required',
        ],
        [
            'diadiem.required'=>'Bạn chưa nhập Địa Điểm',
            'ngaykhoihanh.required'=>'Bạn chưa Ngày Khởi Hành',
            'note.required'=>'Bạn chưa nhập Lưu ý',
        ]);

        $now = Carbon::now();
        $nkh = Date(''.$request->ngaykhoihanh.' 00:00:00');  
        $checkngay = $now->diffInDays($nkh)+1;

        if($checkngay >= 0){
            $tour = new TourModel;

            $tour->cus_id = $idcus;
            $tour->diadiem = $request->diadiem;
            $tour->ngaykhoihanh = $request->ngaykhoihanh;
            $tour->note = $request->note;
            $tour->statuspublic = "0";
            $tour->status = "0";
    
            $tour->save();
            return redirect()->back()->with('thongbao','Thêm tour thành công. Qua danh sách tour để xem ngay !');
        }else{
            return redirect()->back()->with('thongbao','Thêm tour không thành công. Lên Tour phải trước 10 ngày !');
        }  
    }
    public function getEditInformation($iduser,$idcus){
        $user = User::find($iduser);
        $cus = CustomerModel::find($idcus);

        return view('pages.customer.profile.editinfor',['user'=>$user,'cus'=>$cus]);
    }
    public function postEditInformation(Request $request,$iduser, $idcus){
        $this->validate($request,
        [
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'image'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập Họ và Tên',
            'address.required'=>'Bạn chưa nhập Địa Chỉ',
            'phone.required'=>'Bạn chưa nhập Số Điện Thoại',
            'gender.required'=>'Bạn chưa nhập Giới Tính',
            'image.required'=>'Bạn chưa nhập Ảnh Đại Diện',
        ]);

        $customer = CustomerModel::find($idcus);
        
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->gender = $request->gender;
        $customer->phone = $request->phone;

        if($request->hasFile('image')){

            $hinhanh = $request->image;
            $name = $hinhanh->getClientOriginalName();

            $hinhanh->move('./upload/traveller',$name);
            $customer->image = $name;
        }

        $customer->save();
        return redirect()->back()->with('thongbao','Cập nhật thông tin cá nhân thành công');
    }

    public function getHome(){

        return view('pages.customer.index');
    }

    public function getAddTour($iduser){
        $user = User::find($iduser);

        return view('pages.customer.tour.add',['user'=>$user]);
    }

    public function getListTour($iduser){

        $user = User::find($iduser);
        $idcus = $user->customer->id;
        
        $tour = DB::table('tours')->where('cus_id','=',$idcus)->where('status','=',0)->orderBy('timepublic','desc')->get();
        return view('pages.customer.tour.list',['user'=>$user,'tour'=>$tour]);
    }

    public function getSetTour($iduser){
        $user = User::find($iduser);
        $idcus = $user->customer->id;

        $tour = DB::table('tours')->where('cus_id','=',$idcus)->orderBy('timepublic','desc')->get();
        $datcoc = DB::table('datcoc')->where('cus_id','=',$idcus)->where('guide_id','!=',0)->orderBy('deadline','desc')->get();
        $customer = CustomerModel::all();
        $guide = GuideModel::all();
        return view('pages.customer.tour.set',['guide'=>$guide,'customer'=>$customer,'tour'=>$tour,'user'=>$user,'datcoc'=>$datcoc]);
    }

    // incomming
    public function getScheduleTour($iduser){
        $user = User::find($iduser);

        return view('pages.customer.tour.schedule',['user'=>$user]);
    }

    public function getHistory($iduser){
        $user = User::find($iduser);

        return view('pages.customer.tour.history',['user'=>$user]);
    }
    // incomming


    public function getInformation($iduser){
        $user = User::find($iduser);


        return view('pages.customer.profile.information',['user'=>$user]);
    }
    
    public function postAddMoney(Request $request,$iduser,$idcus){
        $user = User::find($iduser);

        $this->validate($request,
        [
            'money'=>'required',
        ],
        [
            'money.required'=>'Nhập số tiền muốn nạp',
        ]);
        
        $cus = CustomerModel::find($idcus);
        $cus->money = $cus->money + $request->money;

        $cus->save();
        return redirect()->back()->with('thongbao','Nạp tài khoản thành công');
    }

    

    public function getAccount($iduser){
        $user = User::find($iduser);

        return view('pages.customer.profile.account',['user'=>$user]);
    }

    public function getNotification($iduser){
        $user = User::find($iduser);

        return view('pages.customer.profile.notification',['user'=>$user]);
    }

    public function getSetting($iduser){
        $user = User::find($iduser);

        return view('pages.customer.profile.setting',['user'=>$user]);
    }

    public function postHuyTour($idtour){
        $tour = TourModel::find($idtour);

        $job = DB::table('jobs')->where('tour_id','=',$idtour)->where('status','=',0)->get();
        foreach($job as $j){
            $idjob = $j->id;
            $findjob = JobModel::find($idjob);
            $findjob->delete();
        }
        $tour->delete();
        return redirect()->back()->with('thongbao','Hủy tour thành công');
    }
}

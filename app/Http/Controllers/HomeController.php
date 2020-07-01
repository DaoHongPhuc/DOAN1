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
use App\GuideRegModel;

class HomeController extends Controller
{
 
    public function getHome(){
        $tour = DB::table('tours')->where('statuspublic','=',1)->where('status','=',0)->orderBy('timepublic','desc')->get();
        $customer = DB::table('customer')->get();
        return view('pages.home',['tour'=>$tour,'customer'=>$customer]);
    }

    public function getLogin(){
        return view('login');
    }

    public function postLoginKH(Request $request){
        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required|min:3',
        ],
        [
            'email.required'=>'Bạn chưa nhập Email',
            'password.required'=>'Bạn chưa nhập Password',
        ]);


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $level = $user->level;
            if($level == 2){
                return redirect('guide/');
            }else{
                return redirect('customer/');
            }
        }else{
            return redirect('login')->with('thongbao','Đăng nhập không thành công');
        }
        
    }
   

    public function getRegisterKH(){
        return view('registerkh');
    }

    public function postRegisterKH(Request $request){
        $today = Date('H:s:i');
        
        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required|min:3',
            'repassword'=>'required|same:password',
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'image'=>'required',
        ],
        [
            'email.required'=>'Bạn chưa nhập Email',
            'password.required'=>'Bạn chưa nhập Password',
            'password.min'=>'Password tối thiểu là 3 ký tự',
            'repassword.required'=>'Bạn chưa nhập Email',
            'repassword.same'=>'Nhập lại Password không trùng khớp',
            'name.required'=>'Bạn chưa nhập Họ và Tên',
            'address.required'=>'Bạn chưa nhập Địa Chỉ',
            'phone.required'=>'Bạn chưa nhập Số Điện Thoại',
            'gender.required'=>'Bạn chưa nhập Giới Tính',
            'image.required'=>'Bạn chưa nhập Ảnh Đại Diện',
        ]);

        //user
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = "1";

        $user->save();
        //kh
        $customer = new CustomerModel;
        $customer->user_id = $user->id;
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->gender = $request->gender;
        $customer->phone = $request->phone;
        $customer->money = "0";

        if($request->hasFile('image')){

            $hinhanh = $request->image;
            $name = $hinhanh->getClientOriginalName();

            $hinhanh->move('./upload/traveller',$name);
            $customer->image = $name;
        }

        $customer->save();
        return redirect()->back()->with('thongbao','Đăng ký tài khoản khách hàng thành công !');
    }

    public function getRegisterHDV(){
        return view('registerhdv');
    }

    public function postRegisterHDV(Request $request){

        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required|min:3',
            'repassword'=>'required|same:password',
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'image'=>'required',
            'local'=>'required',
            'detaillocal'=>'required',
            'desself'=>'required',
            'deslocal'=>'required',
        ],
        [
            'email.required'=>'Bạn chưa nhập Email',
            'password.required'=>'Bạn chưa nhập Password',
            'password.min'=>'Password tối thiểu là 3 ký tự',
            'repassword.required'=>'Bạn chưa nhập Email',
            'repassword.same'=>'Nhập lại Password không trùng khớp',
            'name.required'=>'Bạn chưa nhập Họ và Tên',
            'address.required'=>'Bạn chưa nhập Địa Chỉ',
            'phone.required'=>'Bạn chưa nhập Số Điện Thoại',
            'gender.required'=>'Bạn chưa nhập Giới Tính',
            'image.required'=>'Bạn chưa nhập Ảnh Đại Diện',
            'local.required'=>'Bạn chưa nhập Địa Điểm',
            'detaillocal.required'=>'Bạn chưa nhập Lịch Trinh',
            'desself.required'=>'Bạn chưa nhập Mô Tả Bản Thân',
            'deslocal.required'=>'Bạn chưa nhập Sơ Lược Về Lịch Trình',
        ]);

        // hdv
        $guide = new GuideRegModel;
        $guide->email = $request->email;
        $guide->password = bcrypt($request->password);
        $guide->name = $request->name;
        $guide->address = $request->address;
        $guide->gender = $request->gender;
        $guide->phone = $request->phone;

        if($request->hasFile('image')){

            $hinhanh = $request->image;
            $name = $hinhanh->getClientOriginalName();

            $hinhanh->move('./upload/guide',$name);
            $guide->image = $name;
        }

        $guide->local = $request->local;
        $guide->detaillocal = $request->detaillocal;
        $guide->desself = $request->desself;
        $guide->deslocal = $request->deslocal;

        $guide->save();
        return redirect()->back()->with('thongbao','Đăng ký thành công, chờ ADMIN xác nhận !');
    }

    public function getFP(){
        return view('forgetpassword');
    }
    public function getTourDetail($idtour){
        $tour = TourModel::find($idtour);

        return view('pages.chitiettour',['tour'=>$tour]);
    }

    public function getLogOut(){
        Auth::logout();
        return redirect('login');
        
    }

    public function getChinhSach(){
        return view('chinhsach');
    }
}

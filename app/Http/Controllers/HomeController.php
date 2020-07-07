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

class HomeController extends Controller
{
    public function getListSapToi(){

        $alluser = User::all();
        $diadiem = DiaDiemModel::all();
        

        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
            $lichtrinh = LichTrinhModel::all();
            $hanhtrinh = HanhTrinhModel::all();
            if($user->level == 1){
                $datcoc = DB::table('datcoc')->where('customer_id','=',$iduser)->get();
            }elseif($user->level == 2){
                $datcoc = DB::table('datcoc')->where('guide_id','=',$iduser)->get();
            }else{
                $datcoc = DB::table('datcoc')->get();
                
            }
        }

        return view('pages.danhsachsaptoi',[
            'lichtrinh'=>$lichtrinh,
            'datcoc'=>$datcoc,
            'diadiem'=>$diadiem,
            'hanhtrinh'=>$hanhtrinh,
            'alluser'=>$alluser,
            ]);
    }
    
    public function getTaiKhoan(){

        return view('pages.taikhoan');
    }

    public function postTaiKhoan(Request $request){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }

        $user = User::find($iduser);
        $user->taikhoan += $request->money;
        $user->save();
       
        return redirect()->back()->with('thongbao','Nạp Thành Công');

    }
    public function getChiTietLT($idlt){
        if(Auth::check()){
            $user = Auth::user();
            $iduser = $user->id;
        }
        $lichtrinh = LichTrinhModel::find($idlt);
        $hanhtrinh = DB::table('hanhtrinh')->where('lichtrinh_id','=',$idlt)->get();
        $diadiem = DiaDiemModel::all();

        $job = DB::table('job')->where('user_id','=',$iduser)->get();
        
        return view('pages.chitietlichtrinh',[
            'diadiem'=>$diadiem,
            'job'=>$job,
            'hanhtrinh'=>$hanhtrinh,
            'lichtrinh'=>$lichtrinh]);
    }

    public function getHome(){
        $lichtrinh = LichTrinhModel::all()->where('status','=',1);
        $hanhtrinh = HanhTrinhModel::all();
        $diadiem = DiaDiemModel::all();

        return view('pages.home',['diadiem'=>$diadiem,'hanhtrinh'=>$hanhtrinh,'lichtrinh'=>$lichtrinh]);
    }

    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/');
        }else{
            return redirect()->back()->with('thongbao','Đăng Nhập Không Thành Công');
        }
    }

    public function getRegister(){
        return view('registerkh');
    }

    public function postRegister(Request $request){
        $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required',
            're_password'=>'same:password',
            'password'=>'required|min:3',
        ],
        [
            'email.required'=>'Chưa nhập Email',
            'name.required'=>'Chưa nhập Name',
            'password.required'=>'Chưa nhập Password',
            'password.min'=>'Password tối thiểu 3 ký tự',
            're_password.same'=>'Mật khẩu không trùng khớp',
        ]);
        
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->diadiem = null;
        $user->taikhoan = "0";
        $user->level = "1";

        $user->save();
        return redirect()->back()->with('thongbao','Đăng Ký Thành Công !');
    }

    public function getRegisterHDV(){
        $diadiem = DiaDiemModel::all();

        return view('registerhdv',['diadiem'=>$diadiem]);
    }

    public function postRegisterHDV(Request $request){
        $this->validate($request,
        [
            'name'=>'required',
            'email'=>'required',
            're_password'=>'same:password',
            'password'=>'required|min:3',
            'diadiem'=>'required',
        ],
        [
            'email.required'=>'Chưa nhập Email',
            'diadiem.required'=>'Chưa nhập Địa Điểm',
            'name.required'=>'Chưa nhập Name',
            'password.required'=>'Chưa nhập Password',
            'password.min'=>'Password tối thiểu 3 ký tự',
            're_password.same'=>'Mật khẩu không trùng khớp',
        ]);
        
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->diadiem = $request->diadiem;
        $user->taikhoan = "0";
        $user->level = "2";

        $user->save();
        return redirect()->back()->with('thongbao','Đăng Ký Thành Công !');
    }

    public function getLogout(){
        Auth::logout();

        return redirect('home');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\DiaDiemModel;


class AdminController extends Controller
{
    public function postAdminRegister(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|min:3',
        ],
        [
            'email.required'=>'Chưa nhập Email',
            'name.required'=>'Chưa nhập Name',
            'password.required'=>'Chưa nhập Password',
            'password.min'=>'Password tối thiểu 3 ký tự',
        ]);

        $user = new User;
        if($request->role == 1){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = "1";
            $user->taikhoan = "0";

        }elseif($request->role == 2){
            
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = "2";
            $user->taikhoan = "0";
        }
        $user->save();

        return redirect()->back()->with('thongbao','Tạo thành công');
    }
    public function getAddUser(){
        return view('admin.pages.user');
    }
    public function getLogout(){
        Auth::logout();

        return redirect('admin/login');
    }

    
    public function getDashBoard(){
        return view('admin.pages.dashboard');
    }

    public function getLogin(){
        return view('admin.login');
    }

    public function getListDD(){
        $diadiem = DiaDiemModel::all();

        return view('admin.pages.diadiem.list',['diadiem'=>$diadiem]);
    }

    public function getAddDD(){
        
        return view('admin.pages.diadiem.add');
    }

    public function postAddDD(Request $request){
        $this->validate($request,
        [
            'name'=>'required',
        ],
        [
            'name.required'=>'Chưa nhập Name',
        ]);

        $diadiem = new DiaDiemModel;
        $diadiem->name = $request->name;

        $diadiem->save();
        return redirect()->back()->with('thongbao','Thêm Thành Công');
    }

    
    
    public function postLogin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('admin/dashboard');
        }else{
            return redirect()->back()->with('thongbao','Đăng Nhập Không Thành Công');
        }
    }
}

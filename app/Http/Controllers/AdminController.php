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

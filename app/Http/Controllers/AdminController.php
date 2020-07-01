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
use App\ReportModel;

class AdminController extends Controller
{
    public function getListReport(){
        $report = ReportModel::all();
        $customer = CustomerModel::all();
        $guide = GuideModel::all();
        $tour = TourModel::all();

        return view('admin.pages.notificate.report',['guide'=>$guide,
        'customer'=>$customer,
        'tour'=>$tour,
        'report'=>$report]);
    }

    public function postHuyReg($idgr){
        $guidereg = GuideRegModel::find($idgr);

        $guidereg->delete();
        return redirect()->back()->with('thongbao','Xóa thành công !');
    }

    public function postComfirmGuideReg($idgr){
        $guidereg = GuideRegModel::find($idgr);

        // create user
        $user = new User;
        $user->email = $guidereg->email;
        $user->password = $guidereg->password;
        $user->level = "2";
        $user->save();

        $guide = new GuideModel;
        $guide->name = $guidereg->name;
        $guide->user_id = $user->id;
        $guide->address = $guidereg->address;
        $guide->gender = $guidereg->gender;
        $guide->phone = $guidereg->phone;
        $guide->money = "0";

        $guide->image = $guidereg->image;
        $guide->local = $guidereg->local;
        $guide->detaillocal = $guidereg->detaillocal;
        $guide->desself = $guidereg->desself;
        $guide->deslocal = $guidereg->deslocal;
        $guide->point = "0";

        $guidereg->delete();
        $guide->save();
        return redirect()->back()->with('thongbao','Xác nhận thành công !');
    }

    public function getComfirmGuideReg(){
        $guidereg = GuideRegModel::all();
        return view('admin.pages.notificate.guidereg',['guidereg'=>$guidereg]);
    }

    public function getAdminLogin(){
        return view('admin.login');
    }
    public function postAdminLogin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('admin/dashboard');
        }else{
            return redirect()->back();
        }
    }

    public function getDashBoard(){
        return view('admin.pages.dashboard');
    }

    public function getListCustomer(){
        $customer = DB::table('users')->where('level','=',1)->orderBy('created_at','desc')->get();

        $customerinfo = DB::table('customer')->orderBy('created_at','desc')->get();
        return view('admin.pages.user.customer',['customerinfo'=>$customerinfo,'customer'=>$customer]);
    }
    public function getListGuide(){
        $guide = DB::table('users')->where('level','=',2)->orderBy('created_at','desc')->get();

        $guideinfo = DB::table('guide')->orderBy('created_at','desc')->get();
        return view('admin.pages.user.guide',['guideinfo'=>$guideinfo,'guide'=>$guide]);
    }
    public function getListAdmin(){
        $admin = DB::table('users')->where('level','=',0)->orderBy('created_at','desc')->get();

        $customer = DB::table('customer')->orderBy('created_at','desc')->get();
        return view('admin.pages.user.admin',['admin'=>$admin,'customer'=>$customer]);
    }
    public function getListBlock(){
        // $block = DB::table('users')->where('level','=',2)->orderBy('created_at','desc')->get();

        // foreach($block as $bk){
        //     if()
        // }
        // $customer = DB::table('customer')->orderBy('created_at','desc')->get();
        return view('admin.pages.user.block');
    }

    public function getLogout(){
        Auth::logout();
        return redirect('admin/login');
    }
    
}

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
use App\DiaDiemModel;
use App\DetailDDModel;

class AdminController extends Controller
{

    public function getEditDTPlace($iddtplace){
        $dtdiadiem = DetailDDModel::find($iddtplace);
        $diadiem = DiaDiemModel::all();

        return response()->json(['dtdiadiem'=>$dtdiadiem,'diadiem'=>$diadiem]);
    }

    public function postEditDTPlace(Request $request, $iddtplace){
        $dtdiadiem = DetailDDModel::find($iddtplace);

        $this->validate($request,
        [
            'name'=>'required',
        ],
        [
            'name.required'=>'Chưa nhập tên địa điểm',
        ]);

        $dtdiadiem->diadiem_id = $request->diadiem;
        $dtdiadiem->name = $request->name;
        $dtdiadiem->status = $request->status;

        $dtdiadiem->save();
        return redirect()->back()->with('thongbao','Cập nhật thành công !');

    }

    public function getEditPlace($idplace){
        $diadiem = DiaDiemModel::find($idplace);

        return response()->json(['diadiem'=>$diadiem]);
    }    

    public function postEditPlace(Request $request, $iddtplace){
        $diadiem = DiaDiemModel::find($iddtplace);

        $this->validate($request,
        [
            'name'=>'required',
            // 'image'=>'required',
        ],
        [
            'name.required'=>'Chưa nhập tên địa điểm',
            'image.required'=>'Chưa thêm ảnh địa điểm',
        ]);

        $diadiem->name = $request->name;
        if($request->hasFile('image')){

            $hinhanh = $request->image;
            $name = time() . '_' . rand(0,999999) . '_' . $hinhanh->getClientOriginalName();

            $hinhanh->move('./upload/place',$name);
            $diadiem->image = $name;
        }else{
            $diadiem->image = "";
        }
        $diadiem->status = $request->status;

        $diadiem->save();
        return redirect()->back()->with('thongbao','Cập nhật thành công !');

    }

    public function postHuyPlace($idplace){
        $diadiem = DiaDiemModel::find($idplace);
        
        $check = $diadiem->delete();
        return redirect()->back()->with('thongbao','Xóa thành công !');
    }

    public function postHuyDTPlace($iddtplace){
        $dtdd = DetailDDModel::find($iddtplace);

        $dtdd->delete();
        return redirect()->back()->with('thongbao','Xóa thành công !');

    }

    public function getListDTPlace(){
        $dtdiadiem = DetailDDModel::all();
        
        return view('admin.pages.place.listdtplace',['dtdiadiem'=>$dtdiadiem]);
    }

    public function getListPlace(){
        $diadiem = DiaDiemModel::all();

        return view('admin.pages.place.listplace',['diadiem'=>$diadiem]);
    }

    public function getAddDTPlace(){
        $diadiem = DiaDiemModel::all();
        
        return view('admin.pages.place.adddtplace',['diadiem'=>$diadiem]);
    }

    public function postAddDTPlace(Request $request){
        $this->validate($request,
        [
            'name'=>'required',
        ],
        [
            'name.required'=>'Chưa nhập tên địa điểm',
        ]);

        $dtdiadiem = new DetailDDModel;
        $dtdiadiem->diadiem_id = $request->diadiem;
        $dtdiadiem->name = $request->name;
        $dtdiadiem->status = $request->status;

        $dtdiadiem->save();
        return redirect()->back()->with('thongbao','Thêm thành công !');
    }

    public function getAddPlace(){
        return view('admin.pages.place.addplace');
    }

    public function postAddPlace(Request $request){
        $this->validate($request,
        [
            'name'=>'required',
            'image'=>'required',
        ],
        [
            'name.required'=>'Chưa nhập tên địa điểm',
            'image.required'=>'Chưa thêm ảnh địa điểm',
        ]);

        $diadiem = new DiaDiemModel;
        $diadiem->name = $request->name;
        if($request->hasFile('image')){

            $hinhanh = $request->image;
            $name = time() . '_' . rand(0,999999) . '_' . $hinhanh->getClientOriginalName();

            $hinhanh->move('./upload/place',$name);
            $diadiem->image = $name;
        }
        $diadiem->status = $request->status;

        $diadiem->save();
        return redirect()->back()->with('thongbao','Thêm thành công !');
    }


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

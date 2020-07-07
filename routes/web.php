<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin/login','AdminController@getLogin');
Route::post('admin/login','AdminController@postLogin');

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard','AdminController@getDashBoard');

    Route::get('danhsachdiadiem','AdminController@getListDD');
    Route::get('themdiadiem','AdminController@getAddDD');
    Route::post('themdiadiem','AdminController@postAddDD');


    Route::get('logout','AdminController@getLogout');

});

Route::get('/','HomeController@getHome');
Route::get('home','HomeController@getHome');

Route::get('logout','HomeController@getLogout');

Route::get('login','HomeController@getLogin');
Route::post('login','HomeController@postLogin');

Route::get('register','HomeController@getRegister');
Route::post('register','HomeController@postRegister');

Route::get('registerhdv','HomeController@getRegisterHDV');
Route::post('registerhdv','HomeController@postRegisterHDV');

Route::get('chitietlichtrinh/{idlt}','HomeController@getChiTietLT');

Route::get('danhsachsaptoi','HomeController@getListSapToi');

Route::get('taikhoan','HomeController@getTaiKhoan');
Route::post('taikhoan','HomeController@postTaiKhoan');

Route::group(['middleware'=>'customer'], function () {

    Route::get('themlichtrinh','CustomerController@getAddLichTrinh');
    Route::post('themlichtrinh','CustomerController@postAddLichTrinh');
    
    Route::get('danhsachlichtrinh','CustomerController@getListLichTrinh');

    Route::get('thietlaplichtrinh/{idlt}','CustomerController@getSettingLichTrinh');

    Route::get('themhanhtrinh/{idlt}','CustomerController@getAddHanhTrinh');
    Route::post('themhanhtrinh/{idlt}','CustomerController@postAddHanhTrinh');
    
    Route::get('huyallhanhtrinh/{idlt}','CustomerController@postHuyAllHanhTrinh');

    Route::get('congbolichtrinh/{idlt}','CustomerController@postCongBoLichTrinh');
    Route::get('xoahanhtrinh/{idht}','CustomerController@postXoaHanhTrinh');

    Route::get('nguoinhanhanhtrinh/{idht}','DatCocController@getNguoiNhanHanhTrinh');
    Route::post('nhanhdv/{idj}/{idhdv}/{idht}','DatCocController@postNhanHDV');

    Route::post('huy1hanhtrinhdacoc/{iddc}/{idguide}/{idcus}','DatCocController@postHuy1HTDC');
    Route::post('huyallhanhtrinhdacoc/{idlt}/{idguide}/{idcus}','DatCocController@postHuyAHTDC');
    
});

Route::group(['middleware'=>'guide'], function () {

    Route::get('nhanhanhtrinh/{idlt}/{idht}','GuideController@getNhanHanhTrinh');
    Route::post('nhanhanhtrinh/{idht}','GuideController@postNhanHanhTrinh');

    Route::get('danhsachjob','GuideController@getDanhSachJob');
    Route::post('hdvdc/{iddc}/{idhdv}','DatCocController@postHDVDC');
    
});



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

Route::get('admin/login','AdminController@getAdminLogin');
Route::post('admin/login','AdminController@postAdminLogin');

Route::group(['prefix' => 'admin','middleware'=>'adminlogin'], function () {
    Route::get('dashboard','AdminController@getDashBoard');

    Route::get('listcustomer','AdminController@getListCustomer');
    Route::get('listadmin','AdminController@getListAdmin');
    Route::get('listguide','AdminController@getListGuide');
    Route::get('listblock','AdminController@getListBlock');
    //place
    Route::get('addplace','AdminController@getAddPlace');
    Route::post('addplace','AdminController@postAddPlace');
    Route::get('adddtplace','AdminController@getAddDTPlace');
    Route::post('adddtplace','AdminController@postAddDTPlace');

    Route::get('listplace','AdminController@getListPlace');
    Route::get('listdtplace','AdminController@getListDTPlace');

    Route::get('editplace/{idplace}','AdminController@getEditPlace');
    Route::post('editplace/{idplace}','AdminController@postEditPlace');

    Route::get('editdtplace/{iddtplace}','AdminController@getEditDTPlace');
    Route::post('editdtplace/{iddtplace}','AdminController@postEditDTPlace');

    Route::get('huyplace/{idplace}','AdminController@postHuyPlace');
    Route::get('huydtplace/{iddtplace}','AdminController@postHuyDTPlace');
    // guide reg
    Route::get('guidereg','AdminController@getComfirmGuideReg');
    Route::get('guidereg/{idgr}','AdminController@postComfirmGuideReg');
    Route::get('delguidereg/{idgr}','AdminController@postHuyReg');

    // report
    Route::get('report','AdminController@getListReport');

    Route::get('logout','AdminController@getLogout');
});


Route::get('/','HomeController@getHome');
Route::group(['middleware' => 'login'], function () {
    Route::get('login','HomeController@getLogin');
});

Route::get('chinhsach','HomeController@getChinhSach');

Route::post('loginkh','HomeController@postLoginKH');
Route::get('detaildd','HomeController@getDetailDD');
Route::post('loginhdv','HomeController@postLoginHDV');

Route::get('registerkh','HomeController@getRegisterKH');
Route::post('registerkh','HomeController@postRegisterKH');

Route::get('registerhdv','HomeController@getRegisterHDV');
Route::post('registerhdv','HomeController@postRegisterHDV');

Route::get('forgetpassword','HomeController@getFP');
Route::get('tourdetail/{idtour}','HomeController@getTourDetail');

Route::get('logout','HomeController@getLogOut');

Route::group(['prefix' => 'guide','middleware' => 'guide'], function () {
    Route::get('/','GuideController@getHome');

    // job
    Route::post('addjob/{idtour}','GuideController@postAddJob');

    Route::get('listjob/{iduser}','GuideController@getListJob');
    Route::get('setjob/{iduser}','GuideController@getSetJob');
    Route::get('schedule/{iduser}','GuideController@getScheduleJob');
    Route::get('history/{iduser}','GuideController@getHistory');

    Route::post('guidedatcoc/{idguide}/{idjob}/{iddatcoc}','DatcocController@postGuideDatCoc');


    //profile
    Route::get('information/{iduser}','GuideController@getInformation');

    Route::get('editinfor/{iduser}/{idg}','GuideController@getEditInformation');
    Route::post('editinfor/{iduser}/{idg}','GuideController@postEditInformation');

    Route::get('account/{iduser}','GuideController@getAccount');
    Route::post('account/{iduser}/{idg}','GuideController@postAddMoney');

    Route::get('notification/{iduser}','GuideController@getNotification');
    Route::get('setting/{iduser}','GuideController@getSetting');

    //edit job
    Route::get('editjob/{idjob}','GuideController@getDetailJob');
    Route::post('editjob/{idjob}','GuideController@postEditJob');

    //huy job
    Route::get('huytour/{idjob}','GuideController@postHuyTour');

    //huy coc
    Route::get('huycoc/{idcoc}','DatcocController@postGuideHuyCoc');
});

Route::group(['prefix' => 'customer','middleware' => 'customer'], function () {
    Route::get('/','CustomerController@getHome');

    //tour
    Route::get('addtour/{iduser}','CustomerController@getAddTour');
    Route::post('addtour/{idcus}','CustomerController@postAddTour');

    Route::get('listtour/{iduser}','CustomerController@getListTour');
    Route::get('public/{idtour}','CustomerController@postPublicTour');
    Route::get('viewguideapply/{iduser}/{idtour}','CustomerController@getViewGuideApply');

    Route::post('cusdatcoc/{idcus}/{idtour}','DatcocController@postCustomerDatCoc');

    Route::get('settour/{iduser}','CustomerController@getSetTour');
    Route::get('schedule/{iduser}','CustomerController@getScheduleTour');
    Route::get('history/{iduser}','CustomerController@getHistory');

    //profile
    Route::get('information/{iduser}','CustomerController@getInformation');

    Route::get('editinfor/{iduser}/{idcus}','CustomerController@getEditInformation');
    Route::post('editinfor/{iduser}/{idcus}','CustomerController@postEditInformation');

    Route::get('account/{iduser}','CustomerController@getAccount');
    Route::post('account/{iduser}/{idcus}','CustomerController@postAddMoney');

    Route::get('notification/{iduser}','CustomerController@getNotification');
    Route::get('setting/{iduser}','CustomerController@getSetting');

    // comment
    Route::post('comment/{idcus}/{idguide}','CustomerController@postComment');

    //edit tour
    Route::get('detailtour/{idtour}','CustomerController@getDetailTour');
    Route::get('edittour/{idtour}','CustomerController@getEditTour');
    Route::post('edittour/{idtour}','CustomerController@postEditTour');

    //huy tour
    Route::get('huytour/{idtour}','CustomerController@postHuyTour');

    //huy coc
    Route::get('huycoc/{idcoc}','DatcocController@postCustomerHuyCoc');

    // baocao
    Route::post('report/{idcus}/{idguide}/{idtour}','CustomerController@postReport');

    // ket thuc tour
    Route::get('endtour/{iddatcoc}/{idcus}/{idguide}','CustomerController@postEndTour');
});

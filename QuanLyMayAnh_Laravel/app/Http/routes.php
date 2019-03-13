<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('admin/login', 'login_Controller@getAdminLogin');
Route::post('admin/login', 'login_Controller@postAdminLogin');
Route::get('admin/logout', 'login_Controller@LogoutAdmin');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
    Route::group(['prefix' => 'nsx'], function () {
        Route::get('list', 'getList_Controller@getListNSX');

        Route::get('add', 'nsx_Controller@getadd');
        Route::post('add', 'nsx_Controller@postadd');

        Route::get('edit/{id}', 'nsx_Controller@getEdit');
        Route::get('edit', 'nsx_Controller@getMenuEdit');
        Route::post('edit', 'nsx_Controller@postEdit');

        Route::get('delete/{id}', 'nsx_Controller@getDelete');
        Route::get('delete', 'nsx_Controller@getMenuDelete');
        Route::post('delete', 'nsx_Controller@postDelete');

        Route::get('khoiphuc/{id}', 'nsx_Controller@khoiphucnsx');
    });
    Route::group(['prefix' => 'danhmuc'], function () {
        Route::get('list', 'getList_Controller@getListDanhmuc');

        Route::get('add', 'danhmuc_Controller@getadd');
        Route::post('add', 'danhmuc_Controller@postadd');

        Route::get('edit/{id}', 'danhmuc_Controller@getEdit');
        Route::get('edit', 'danhmuc_Controller@getMenuEdit');
        Route::post('edit', 'danhmuc_Controller@postEdit');

        Route::get('delete/{id}', 'danhmuc_Controller@getDelete');
        Route::get('delete', 'danhmuc_Controller@getMenuDelete');
        Route::post('delete', 'danhmuc_Controller@postDelete');

        Route::get('khoiphuc/{id}', 'danhmuc_Controller@khoiphucdanhmuc');
    });
    Route::group(['prefix' => 'sanpham'], function () {
        Route::get('list', 'getList_Controller@getListSanPham');

        Route::get('add', 'sanpham_Controller@getadd');
        Route::post('add', 'sanpham_Controller@postadd');

        Route::get('edit', 'sanpham_Controller@getEdit');
        Route::post('edit', 'sanpham_Controller@postEdit');

        Route::get('delete', 'sanpham_Controller@getDelete');
        Route::get('delete/{id}', 'sanpham_Controller@Delete');

        Route::get('khoiphuc/{id}', 'sanpham_Controller@KhoiPhuc');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('list', 'getList_Controller@getListUser');
        
        Route::get('add', 'user_Controller@getAdd');
        Route::post('add', 'user_Controller@postAdd');

        Route::get('edit', 'user_Controller@getEdit');
        Route::post('edit', 'user_Controller@postEdit');

        Route::get('delete', 'user_Controller@getDelete');
        Route::get('delete/{id}', 'user_Controller@postDelete');
        Route::get('khoiphuc/{id}', 'user_Controller@khoiphucDelete');
    });
    Route::group(['prefix' => 'donhang'], function () {
        Route::get('list', 'getList_Controller@getListDonhang');
    });
    Route::group(['prefix' => 'ajax'], function () {
        Route::post('editSanpham', 'ajax_Controller@LoadEdit_Sanpham');
        Route::post('editUser', 'ajax_Controller@LoadEdit_User');
        Route::post('updateTrangthaiDonghang', 'ajax_Controller@updateTrangthai');
    });
});


Route::group(['prefix' => 'websales'], function () {
    Route::get('dangnhap', 'login_Controller@getLoginUser');
    Route::post('dangnhap', 'login_Controller@postLoginUser');
    Route::get('dangxuat', 'login_Controller@LogoutUser');
    Route::get('dangky', 'login_Controller@getDangky');
    Route::post('dangky', 'login_Controller@postDangky');

    Route::get('home', 'home_Controller@getData');

    Route::get('chitiet/{id}', 'home_Controller@getChitiet');

    Route::get('nsx/{id}', 'home_Controller@getSanphamNSX');

    Route::get('danhmuc/{id}', 'home_Controller@getSanphamDanhmuc');

    Route::post('themSPgiohang', 'ajax_Controller@themSP_giohang');

    Route::get('giohang', 'home_Controller@getGiohang');

    Route::post('capnhatgiohang', 'ajax_Controller@capNhat_giohang');

    Route::post('xoa1spGiohang', 'ajax_Controller@xoa1spGiohang');

    Route::post('xoaGiohang', 'ajax_Controller@xoaGiohang');

    Route::get('thongtincanhan', 'home_Controller@getThongtin')->middleware('checkLoginUser');
    Route::post('thongtincanhan', 'home_Controller@postThongtin')->middleware('checkLoginUser');
    
    Route::post('thanhtoan', 'ajax_Controller@ThanhToan')->middleware('checkLoginUser');

    Route::get('lichsumua', 'home_Controller@getLichSuMua')->middleware('checkLoginUser');
});



route::get('abc/test', 'ajax_Controller@test');
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Models\danhmuc;
use App\Http\Models\nsx;
use App\Http\Models\sanpham;
use App\Http\Models\donhang;
use Auth;
use App\Http\Requests;

class getList_Controller extends Controller
{
    //
    function __construct () {
        $count_User = User::where('Trangthai', '1')->count();
        $count_nsx = nsx::where('Trangthai', '1')->count();
        $count_danhmuc = danhmuc::where('Trangthai', '1')->count();
        $count_sanpham = sanpham::where('Trangthai', '1')->count();
        
        //gọi lại check đăng nhập của __construct() class Controller cho __construct() getList_Controller
        // vì getList_Controller đang tự định nghĩa lại __construct().
        $this->DangNhap();

        // view() của các function bên dưới đều sẽ nhận được các biến của view()->share
        view()->share('count_User', $count_User);
        view()->share('count_nsx', $count_nsx);
        view()->share('count_danhmuc', $count_danhmuc);
        view()->share('count_sanpham', $count_sanpham);
    }

    public function getListUser () {
        $list_user = User::all();
        return view('admin.user.list', ['list_user' => $list_user]);
    }

    public function getListSanPham () {
        $list_sanpham = sanpham::all();
        $list_nsx = nsx::all();
        $list_danhmuc = danhmuc::all();

        // tạo 1 mảng key=>value
        $nsx_arr = [];
        foreach ($list_nsx as $nsx) {
            $nsx_arr[$nsx->id] = $nsx->TenNSX;
        }

        // tạo 1 mảng key=>value
        $danhmuc_arr = [];
        foreach ($list_danhmuc as $danhmuc) {
            $danhmuc_arr[$danhmuc->id] = $danhmuc->TenLoai;
        }

        // so sánh key của 2 mảng trên với các item của $sp để mapping tên tương ứng.
        $sanpham = [];
        foreach ($list_sanpham as $sp) {
            if (array_key_exists($sp->id_NSX, $nsx_arr)) {
                $sp->TenNSX = $nsx_arr[$sp->id_NSX];
            }
            if (array_key_exists($sp->id_Loai, $danhmuc_arr)) {
                $sp->TenLoai = $danhmuc_arr[$sp->id_Loai];
            }
            array_push($sanpham, $sp);
        }

        return view('admin.sanpham.list', ['list_sanpham' => $sanpham]);
    }

    public function getListDanhmuc () {
        $list_danhmuc = danhmuc::all();
        return view('admin.danhmuc.list', ['list_danhmuc' => $list_danhmuc]);
    }

    public function getListNSX () {
        $list_nsx = nsx::all();
        return view('admin.nsx.list', ['list_nsx' => $list_nsx]);
    }

    public function getListDonhang () {
        $donhang = donhang::all();
        return view('admin.donhang.list', ['donhang' => $donhang]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\danhmuc;
use App\Http\Models\nsx;
use App\Http\Models\sanpham;
use App\Http\Models\User;
use App\Http\Models\donhang;
use App\Http\Models\ct_donhang;
use Auth;
use App\Http\Requests;

class home_Controller extends Controller
{
    //
    function __construct () {
        // pages != home
        // menu-right pages 
        $sum = sanpham::where('Trangthai', '<>', 0)->count();
        $random = rand(1, $sum-4);
        $sp_menu_rand_active = sanpham::where('Trangthai', '<>', 0)->orderBy('id', 'ASC')->skip($random)->take(1)->get();
        $sp_menu_rand = sanpham::where('Trangthai', '<>', 0)->orderBy('id', 'ASC')->skip($random+1)->take(3)->get();

        $danhmuc_menu = danhmuc::where('Trangthai', '<>', 0)->get();
        $nsx_menu = nsx::where('Trangthai', '<>', 0)->get();
        $sanpham_menu_topSale = sanpham::where('Trangthai', '<>', 0)->orderBy('SoLuongDaBan', 'DESC')->take(3)->get();

        // menu-top
        $danhmuc_menuTop = danhmuc::where('Trangthai', '<>', 0)->get();
        $nsx_menuTop = nsx::where('Trangthai', '<>', 0)->get();

        //gọi lại check đăng nhập của __construct() class Controller cho __construct() getList_Controller
        // vì home_Controller đang tự định nghĩa lại __construct().
        $this->DangNhap();

        //menu-right pages
        view()->share('sp_menu_rand_active', $sp_menu_rand_active);
        view()->share('sp_menu_rand', $sp_menu_rand);
        view()->share('danhmuc_menu', $danhmuc_menu);
        view()->share('nsx_menu', $nsx_menu);
        view()->share('sanpham_menu_topSale', $sanpham_menu_topSale);
        //menu-top
        view()->share('danhmuc_menuTop', $danhmuc_menuTop);
        view()->share('nsx_menuTop', $nsx_menuTop);
    }

    // home
    public function getData (Request $req) {
        // content
        $sanpham_topView_active = sanpham::where('Trangthai', '<>', '0')->orderBy('LuotXem', 'DESC')->take(4)->get();
        $sanpham_topView_1 = sanpham::where('Trangthai', '<>', '0')->orderBy('LuotXem', 'DESC')->skip(4)->take(4)->get();
        $sanpham_topView_2 = sanpham::where('Trangthai', '<>', '0')->orderBy('LuotXem', 'DESC')->skip(8)->take(4)->get();

        $sanpham_topSale_active = sanpham::where('Trangthai', '<>', '0')->orderBy('SoLuongDaBan', 'DESC')->take(4)->get();
        $sanpham_topSale_1 = sanpham::where('Trangthai', '<>', '0')->orderBy('SoLuongDaBan', 'DESC')->skip(4)->take(4)->get();
        $sanpham_topSale_2 = sanpham::where('Trangthai', '<>', '0')->orderBy('SoLuongDaBan', 'DESC')->skip(8)->take(4)->get();

        $data = [
            'sanpham_topView_active' => $sanpham_topView_active,
            'sanpham_topView_1' => $sanpham_topView_1,
            'sanpham_topView_2' => $sanpham_topView_2,
            'sanpham_topSale_active' => $sanpham_topSale_active,
            'sanpham_topSale_1' => $sanpham_topSale_1,
            'sanpham_topSale_2' => $sanpham_topSale_2
        ];
        
        return view('customer.home.home_index', $data);
    }

    //
    public function getChitiet ($id) {
        $sanpham = sanpham::find($id);

        if ($sanpham) {
            $sanpham->LuotXem = $sanpham->LuotXem + 1;
            $sanpham->save();

            $tong_sl = sanpham::where('id_Loai', $sanpham->id_Loai)->count();
            if ($tong_sl <= 6) {
                $num_rand = 0;
            } else {
                $num_rand = rand(1, $tong_sl - 6); // tránh trường hợp random vào 6 sp cuối => không đủ sp để hiển thị "cần 6 sản phẩm để hiển thị"
            }
            $sanpham_cungloai_active = sanpham::where('id_Loai', $sanpham->id_Loai)->where('Trangthai', '<>', 0)->skip($num_rand)->take(3)->get();
            $sanpham_cungloai = sanpham::where('id_Loai', $sanpham->id_Loai)->where('Trangthai', '<>', 0)->skip($num_rand + 3)->take(3)->get();

            $data = [
                'sanpham' => $sanpham,
                'sanpham_cungloai_active' => $sanpham_cungloai_active,
                'sanpham_cungloai' => $sanpham_cungloai
            ];

            if ($sanpham->Trangthai != 0) {
                return view('customer.chitiet', $data);
            } else {
                return view('errors.503');
            }
        } else {
            return view('errors.503');
        }
    }

    public function getSanphamNSX ($id) {
        $nsx = nsx::find($id);
        $sanpham_NSX = sanpham::where('id_NSX', $id)->where('Trangthai', '<>', 0)->paginate(9);

        $data = [
            'sanpham_NSX' => $sanpham_NSX,
            'nsx' => $nsx
        ];
        
        if ($nsx) {
            if ($sanpham_NSX) {
                return view('customer.nsx', $data);
            } else {
                return view('errors.503');
            }
        } else {
            return view('errors.503');
        }
    }

    public function getSanphamDanhmuc ($id) {
        $danhmuc = danhmuc::find($id);
        $sanpham_Danhmuc = sanpham::where('id_Loai', $id)->where('Trangthai', '<>', 0)->paginate(9);

        $data = [
            'sanpham_Danhmuc' => $sanpham_Danhmuc,
            'danhmuc' => $danhmuc
        ];

        if ($danhmuc) {
            if ($sanpham_Danhmuc) {
                return view('customer.danhmuc', $data);
            } else {
                return view('errors.503');
            }
        } else {
            return view('errors.503');
        }
    }

    public function getGiohang (Request $req) {
        if ($req->session()->has('giohang')) {
            $giohang = $req->session()->get('giohang');
            $tongtien = $req->session()->get('tongtien_giohang');
            $data = [
                'tongtien' => $tongtien,
                'giohang' => $giohang,
                'stt' => 1,
            ];
            return view('customer.giohang', $data);
        } else {
            return view('customer.giohang');
        }
    }

    public function getThongtin () {
        return view('customer.thongtin_nguoidung');
    }

    public function postThongtin (Request $req) {
        $user = User::find($req->id_user);
        $this->validate($req,
            [
                'tenkh' => 'required|max:100',
                'email' => 'required|email',
                'password' => 'max:40',
                'dienthoai' => 'required|max:11|min:10',
                'diachi' => 'required|max:500',
            ],
            [
                'username.required' => 'Tài khoản không được để trống',
                'username.unique' => 'Tài khoản đã tồn tại',
                'username.max' => 'Tài khoản không dài quá 50 ký tự',
                'tenkh.required' => 'Tên người dùng không được để trống',
                'tenkh.max' => 'Tên người dùng quá dài',
                'email.required' => 'Email không được để trống',
                'email.email' => 'Email không đúng định dạng',
                'password.min' => 'Mật khẩu phải nhiều hơn 6 ký tự',
                'password.max' => 'Mật khẩu phải ít hơn 40 ký tự',
                'dienthoai.required' => 'Số điện thoại không được để trống',
                'dienthoai.max' => 'Số điện thoại không hợp lệ',
                'dienthoai.min' => 'Số điện thoại không hợp lệ',
                'diachi.required' => 'Địa chỉ không được để trống',
                'diachi.max' => 'Địa chỉ quá dài',
            ]
        );
        $user->TenKH = $req->tenkh;
        $user->email = $req->email;
        if (!empty($req->password)) {
            $user->password = bcrypt($req->password);
        }
        $user->SDT = $req->dienthoai;
        $user->DiaChi = $req->diachi;
        if ($user->save()) {
            return redirect('websales/thongtincanhan')->with('notification', ' thành công');
        } else {
            return view('errors.503');
        }
    }

    public function getLichSuMua () {
        $donhang = donhang::where('id_user', Auth::user()->id)->get();
        foreach ($donhang as $dh) {
            $ct_dh = donhang::find($dh->id)->ct_donhang;
        }

        $sanpham = sanpham::all();
        $sanpham_arr = [];
        foreach ($sanpham as $sp) {
            $sanpham_arr[$sp->id] = $sp->TenSP;
        }

        $ct_donhang_arr = [];
        foreach($ct_dh as $ct) {
            if (array_key_exists($ct->id_SP, $sanpham_arr)) {
                $ct->TenSP = $sanpham_arr[$ct->id_SP];
            }
            array_push($ct_donhang_arr, $ct);
        }
        return view('customer.lichsumua', ['ct_donhang_arr' => $ct_donhang_arr]);
    }
}

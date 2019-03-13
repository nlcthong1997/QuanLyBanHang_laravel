<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Models\User;
use App\Http\Requests;

class login_Controller extends Controller
{
    // Admin
    public function getAdminLogin () {
        return view('admin.login.login');
    }

    public function postAdminLogin (Request $req) {
        $remember = ($req->has('remember_password')) ? true : false;
        $this->validate($req,
                [
                    'username' => 'required|max:50',
                    'password' => 'required'
                ],
                [
                    'username.required' => 'Vui lòng nhập tài khoản.',
                    'username.max' => 'Tài khoản không đúng.',
                    'password.required' => 'Vui lòng nhập mật khẩu.'
                ]
            );

        if (Auth::attempt(['username' => $req->username, 'password' => $req->password, 'Trangthai' => 1], $remember)) {
            return redirect('admin/sanpham/list');
        } else {
            return redirect('admin/login')->with('notification', 'Đăng nhập thất bại');
        }
    }

    public function LogoutAdmin () {
        Auth::logout();
        return redirect('admin/login');
    }

    //User
    public function getLoginUser () {
        return view('customer.dangnhap');
    }

    public function postLoginUser (Request $req) {
        $remember = ($req->has('remember_password')) ? true : false;
        $this->validate($req,
            [
                'username' => 'required|max:50',
                'password' => 'required'
            ],
            [
                'username.required' => 'Vui lòng nhập tài khoản.',
                'username.max' => 'Tài khoản không đúng.',
                'password.required' => 'Vui lòng nhập mật khẩu.'
            ]
        );
        if (Auth::attempt(['username' => $req->username, 'password' => $req->password, 'Trangthai' => 1], $remember)) {
            return redirect('websales/home');
        } else {
            return redirect('websales/dangnhap')->with('notification', ' thất bại');
        }
    }

    public function LogoutUser (Request $req) {
        Auth::logout();
        if ($req->path() == 'websales/lichsumua') {
            return redirect('websales/home');
        } else {
            return redirect()->back();
        }
    }

    public function getDangky () {
        return view('customer.dangky');
    }

    public function postDangky (Request $req) {
        $user = new User;
        $this->validate($req,
            [
                'username' => 'required|unique:users,username|max:50',
                'tenkh' => 'required|max:100',
                'email' => 'required|email',
                'password' => 'required|max:40',
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
                'password.required' => 'Mật khẩu không được để trống',
                'password.min' => 'Mật khẩu phải nhiều hơn 6 ký tự',
                'password.max' => 'Mật khẩu phải ít hơn 40 ký tự',
                'dienthoai.required' => 'Số điện thoại không được để trống',
                'dienthoai.max' => 'Số điện thoại không hợp lệ',
                'dienthoai.min' => 'Số điện thoại không hợp lệ',
                'diachi.required' => 'Địa chỉ không được để trống',
                'diachi.max' => 'Địa chỉ quá dài',
            ]
        );
        $user->username = $req->username;
        $user->password = bcrypt($req->password);
        $user->TenKH = $req->tenkh;
        $user->email = $req->email;
        $user->SDT = $req->dienthoai;
        // $user->NgaySinh = date('Y-m-d', strtotime($req->ngaysinh.'/'.$req->thangsinh.'/'.$req->namsinh));
        $user->DacQuyen = 0;
        $user->DiaChi = $req->diachi;
        $user->Trangthai = 1;
        if ($user->save()) {
            //Đăng ký thành công cho đăng nhập luôn
            if(Auth::attempt(['username' => $req->username, 'password' => $req->password, 'Trangthai' => 1])) {
                return redirect()->back()->with('notification_s', ' thành công');
            } else {
                return redirect()->back()->with('notification_l', ' thất bại');
            }
        } else {
            return redirect()->back()->with('notification_l', ' thất bại');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Requests;

class user_Controller extends Controller
{
    // 

    public function getAdd () {
        $begin_year = 1900; 
        $now_year = date('Y', time());
        return view('admin.user.add', ['begin_year' => $begin_year, 'now_year' => $now_year]);
    }

    public function postAdd (Request $req) {
        $user = new User;
        $this->validate($req,
                [
                    'username' => 'required|unique:users,username|max:50',
                    'email' => 'required|email',
                    'password' => 'required|max:40|min:6',
                    'tenkh' => 'required|max:100',
                    'diachi' => 'required|max:500',
                    'dienthoai' => 'required|max:11|min:10',
                    'dacquyen' => 'required',
                ],
                [
                    'username.required' => 'Tài khoản không được để trống',
                    'username.unique' => 'Tài khoản đã tồn tại',
                    'username.max' => 'Tài khoản không dài quá 50 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Email không đúng định dạng',
                    'password.required' => 'Mật khẩu không được để trống',
                    'password.min' => 'Mật khẩu phải nhiều hơn 6 ký tự',
                    'password.max' => 'Mật khẩu phải ít hơn 40 ký tự',
                    'tenkh.required' => 'Tên người dùng không được để trống',
                    'tenkh.max' => 'Tên người dùng quá dài',
                    'diachi.required' => 'Địa chỉ không được để trống',
                    'diachi.max' => 'Địa chỉ quá dài',
                    'dienthoai.required' => 'Số điện thoại không được để trống',
                    'dienthoai.max' => 'Số điện thoại không hợp lệ',
                    'dienthoai.min' => 'Số điện thoại không hợp lệ',
                    'dacquyen.required' => 'Quyền user không được để trống'
                ]
            );
        $user->username = $req->username;
        $user->password = bcrypt($req->password);
        $user->TenKH = $req->tenkh;
        $user->email = $req->email;
        $user->SDT = $req->dienthoai;
        $user->NgaySinh = date('Y-m-d', strtotime($req->ngaysinh.'/'.$req->thangsinh.'/'.$req->namsinh));
        $user->DacQuyen = $req->dacquyen;
        $user->DiaChi = $req->diachi;
        $user->Trangthai = 1;
        if ($user->save()) {
            return redirect('admin/user/add')->with('notification', 'Thêm thành công');
        } else {
            return view('errors.503');
        }
    }

    public function getEdit () {
        $begin_year = 1900; 
        $now_year = date('Y', time());
        $user = User::all();
        return view('admin.user.edit', ['user' => $user, 'begin_year' => $begin_year, 'now_year' => $now_year]);
    }

    public function postEdit (Request $req) {
        $user_edit = User::find($req->chonUser);
        $this->validate($req,
                [
                    'username' => 'required|max:50',
                    'email' => 'required|email',
                    'password' => 'max:40',
                    'tenkh' => 'required|max:100',
                    'diachi' => 'required|max:500',
                    'dienthoai' => 'required|max:11|min:10',
                    'dacquyen' => 'required',
                ],
                [
                    'username.required' => 'Tài khoản không được để trống',
                    'username.max' => 'Tài khoản không dài quá 50 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Email không đúng định dạng',
                    'password.max' => 'Mật khẩu phải ít hơn 40 ký tự',
                    'tenkh.required' => 'Tên người dùng không được để trống',
                    'tenkh.max' => 'Tên người dùng quá dài',
                    'diachi.required' => 'Địa chỉ không được để trống',
                    'diachi.max' => 'Địa chỉ quá dài',
                    'dienthoai.required' => 'Số điện thoại không được để trống',
                    'dienthoai.max' => 'Số điện thoại không hợp lệ',
                    'dienthoai.min' => 'Số điện thoại không hợp lệ',
                    'dacquyen.required' => 'Quyền user không được để trống'
                ]
            );
        $user_edit->username = $req->username;
        if (!empty($req->password)) {
            $user_edit->password = bcrypt($req->password);
        }
        $user_edit->TenKH = $req->tenkh;
        $user_edit->email = $req->email;
        $user_edit->SDT = $req->dienthoai;
        $user_edit->NgaySinh = date('Y-m-d', strtotime($req->ngaysinh.'/'.$req->thangsinh.'/'.$req->namsinh));
        $user_edit->DacQuyen = $req->dacquyen;
        $user_edit->DiaChi = $req->diachi;
        if ($user_edit->save()) {
            return redirect('admin/user/edit')->with('notification', 'Chỉnh sửa thành công');
        } else {
            return view('errors.503');
        }
    }

    public function getDelete () {
        $list_user = User::all();
        return view('admin.user.delete', ['list_user' => $list_user]);
    }

    public function postDelete ($id) {
        $user = User::find($id);
        $user->Trangthai = 0;
        if ($user->save()) {
            return redirect('admin/user/delete');
        } else {
            return view('errors.503');
        }
    }

    public function khoiphucDelete ($id) {
        $user = User::find($id);
        $user->Trangthai = 1;
        if ($user->save()) {
            return redirect('admin/user/delete');
        } else {
            return view('errors.503');
        }
    }
}

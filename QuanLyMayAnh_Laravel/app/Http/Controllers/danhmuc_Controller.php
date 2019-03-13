<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\danhmuc;
use App\Http\Requests;

class danhmuc_Controller extends Controller
{
    //
    public function getadd () {
        return view('admin.danhmuc.add');
    }

    public function postadd (Request $req) {
        $danhmuc = new danhmuc;
        $this->validate($req,
                ['tendanhmuc' => 'required|unique:danhmuc,TenLoai|max:50'],
                [
                    'tendanhmuc.required' => 'Tên không được trống.',
                    'tendanhmuc.unique' => 'Tên này đã tồn tại.',
                    'tendanhmuc.max' => 'Tên không được quá 50 ký tự.'
                ]
            );
        $danhmuc->TenLoai = $req->tendanhmuc;
        $danhmuc->Trangthai = 1; //Đang tồn tại
        if ($danhmuc->save()) {
            return redirect('admin/danhmuc/add')->with('notification', 'Thêm thành công');
        } else {
            return view('errors.503');
        }
    }

    public function getEdit ($id) {
        $danhmuc = danhmuc::find($id);
        return view('admin.danhmuc.edit', ['danhmuc' => $danhmuc]);
    }

    public function getMenuEdit () {
        $list_danhmuc = danhmuc::all();
        return view('admin.danhmuc.edit_menu', ['list_danhmuc' => $list_danhmuc]);
    }

    public function postEdit (Request $req) {
        $danhmuc = danhmuc::find($req->idDanhmuc);
        $this->validate($req,
                ['TenSuaDoi' => 'required|unique:danhmuc,TenLoai|max:50'],
                [
                    'TenSuaDoi.required' => 'Tên sửa đổi không được trống.',
                    'TenSuaDoi.unique' => 'Tên sửa đổi đã tồn tại.',
                    'TenSuaDoi.max' => 'Tên không được quá 50 ký tự.'
                ]
            );
        $danhmuc->TenLoai = $req->TenSuaDoi;
        if ($danhmuc->save()) {
            return redirect('admin/danhmuc/edit')->with('notification', 'Sửa thành công');
        } else {
            return view('errors.503');
        }
    }

    public function getDelete ($id) {
        $danhmuc = danhmuc::find($id);
        $list_danhmuc = danhmuc::all();
        return view('admin.danhmuc.delete', ['danhmuc' => $danhmuc, 'list_danhmuc' => $list_danhmuc]);
    }

    public function getMenuDelete () {
        $list_danhmuc = danhmuc::all();
        return view('admin.danhmuc.delete_menu', ['list_danhmuc' => $list_danhmuc]);
    }

    public function postDelete (Request $req) {
        $danhmuc = danhmuc::find($req->idDanhmuc);
        $danhmuc->Trangthai = 0; // Đã xóa
        if ($danhmuc->save()) {
            return redirect('admin/danhmuc/delete')->with('notification', 'Xóa thành công');
        } else {
            return view('errors.503');
        }
    }

    public function khoiphucdanhmuc ($id) {
        $danhmuc = danhmuc::find($id);
        $danhmuc->Trangthai = 1;
        if ($danhmuc->save()) {
            return redirect('admin/danhmuc/list');
        } else {
            return view('errors.503');
        }
    }
}

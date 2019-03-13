<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\nsx;
use App\Http\Requests;

class nsx_Controller extends Controller
{
    //

    public function getadd () {
        return view('admin.nsx.add');
    }

    public function postadd (Request $req) {
        $nsx = new nsx;
        $this->validate($req,
                ['tennsx' => 'required|unique:nsx,TenNSX|max:50'],
                [
                    'tennsx.required' => 'Tên không được trống.',
                    'tennsx.unique' => 'Tên này đã tồn tại.',
                    'tennsx.max' => 'Tên không được quá 50 ký tự.'
                ]
            );
        $nsx->TenNSX = $req->tennsx;
        $nsx->Trangthai = 1; //Đang tồn tại
        if($nsx->save()) {
            return redirect('admin/nsx/add')->with('notification', 'Thêm thành công');
        } else {
            return view('errors.503');
        }
    }

    public function getEdit ($id) {
        $nsx = nsx::find($id);
        return view('admin.nsx.edit', ['nsx' => $nsx]);
    }

    public function getMenuEdit () {
        $list_nsx = nsx::all();
        return view('admin.nsx.edit_menu', ['list_nsx' => $list_nsx]);
    }

    public function postEdit (Request $req) {
        $nsx = nsx::find($req->idNSX);
        $this->validate($req,
                ['TenSuaDoi' => 'required|unique:nsx,TenNSX|max:50'],
                [
                    'TenSuaDoi.required' => 'Tên sửa đổi không được trống.',
                    'TenSuaDoi.unique' => 'Tên sửa đổi đã tồn tại.',
                    'TenSuaDoi.max' => 'Tên không được quá 50 ký tự.'
                ]
            );
        $nsx->TenNSX = $req->TenSuaDoi;
        if ($nsx->save()) {
            return redirect('admin/nsx/edit')->with('notification', 'Sửa thành công');
        } else {
            return view('errors.503');
        }
    }

    public function getDelete ($id) {
        $nsx = nsx::find($id);
        $list_nsx = nsx::all();
        return view('admin.nsx.delete', ['nsx' => $nsx, 'list_nsx' => $list_nsx]);
    }

    public function getMenuDelete () {
        $list_nsx = nsx::all();
        return view('admin.nsx.delete_menu', ['list_nsx' => $list_nsx]);
    }

    public function postDelete (Request $req) {
        $nsx = nsx::find($req->idNSX);
        $nsx->Trangthai = 0; // Đã xóa
        if ($nsx->save()) {
            return redirect('admin/nsx/delete')->with('notification', 'Xóa thành công');
        } else {
            return view('errors.503');
        }
    }

    public function khoiphucnsx ($id) {
        $nsx = nsx::find($id);
        $nsx->Trangthai = 1;
        if($nsx->save()) {
            return redirect('admin/nsx/list');
        } else {
            return view('errors.503');
        }
    }

}

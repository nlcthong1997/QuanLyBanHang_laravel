<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\sanpham;
use App\Http\Models\nsx;
use App\Http\Models\danhmuc;
use File;
use Image;
use App\Http\Requests;

class sanpham_Controller extends Controller
{
    //
    public function getadd () {
        $list_nsx = nsx::all();
        $list_danhmuc = danhmuc::all();
        return view('admin.sanpham.add', ['list_nsx' => $list_nsx, 'list_danhmuc' => $list_danhmuc]);
    }

    public function postadd (Request $req) {
        $sanpham = new sanpham;
        $this->validate($req,
                [
                    'tensp' => 'required|max:100',
                    'danhgia' => 'max:300',
                    'chitiet' => 'required',
                    'gia' => 'required',
                    'soluong' => 'required',
                    'anhlon' => 'required',
                    'anhnho' => 'required'
                ],
                [
                    'tensp.required' => 'Tên không được để trống.',
                    'tensp.max' => 'Tên không quá 100 ký tự',
                    'danhgia.max' => 'Đánh giá quá dài',
                    'chitiet.required' => 'Chi tiết không được để trống',
                    'gia.required' => 'Giá không được để trống',
                    'soluong.required' => 'Số lượng không được để trống',
                    'anhlon.required' => 'Ảnh không được để trống',
                    'anhnho.required' => 'Ảnh không được để trống',
                ]
            );
        $sanpham->TenSP = $req->tensp;
        $sanpham->id_Loai = $req->idDanhmuc;
        $sanpham->id_NSX = $req->idNSX;
        $sanpham->DanhGia = $req->danhgia;
        $sanpham->ChiTiet = $req->chitiet;
        $sanpham->Gia = $req->gia;
        $sanpham->SoLuong = $req->soluong;
        $sanpham->LuotXem = 0;
        $sanpham->NgayNhap = date('Y-m-d H:i:s', time());
        $sanpham->Trangthai = 1; // sản phẩm hiện đang tồn tại
        
        if ($sanpham->save()) {
            $last_id_inserted = $sanpham->id; // lấy id của sản phẩm vừa thêm.

            // Tạo thư mục chứa ảnh
            $link_folder = '/upload/sanpham/'. $last_id_inserted;
            $path = public_path($link_folder);
            File::makeDirectory($path, $mode = 0777, true, true);
            
            function check_saveFileImage ($req, $path, $nameInputFile, $width, $height, $nameFile, $extension) {
                if ($req->hasFile($nameInputFile)) {
                    //get file
                    $file = $req->file($nameInputFile);
                    //resize ảnh
                    $resizeImage = Image::make($file)->resize($width, $height);
                    // upload
                    $resizeImage->save($path.'/'.$nameFile.'.'.$extension); 
                }
            }
            check_saveFileImage($req, $path, 'anhlon', 350, 350, 'big', 'jpg');
            check_saveFileImage($req, $path, 'anhnho', 200, 200, 'small', 'jpg');

            return redirect('admin/sanpham/add')->with('notification', 'Thêm thành công.');
        } else {
            return view('errors.503');
        }
    }

    public function getEdit () {
        $list_sanpham = sanpham::all();
        $list_nsx = nsx::all();
        $list_danhmuc = danhmuc::all();
        // var_dump($sanpham);
        return view('admin.sanpham.edit', ['list_sanpham' => $list_sanpham, 'list_nsx' => $list_nsx, 'list_danhmuc' => $list_danhmuc]);
    }

    public function postEdit (Request $req) {
        $sanpham = sanpham::find($req->idsp_edit);
        $this->validate($req,
                [
                    'tensp_edit' => 'required|max:100',
                    'danhgia_edit' => 'max:300',
                    'chitiet_edit' => 'required',
                    'giaban_edit' => 'required',
                    'soluong_edit' => 'required'
                ],
                [
                    'tensp_edit.required' => 'Tên không được để trống.',
                    'tensp_edit.max' => 'Tên không quá 100 ký tự',
                    'danhgia_edit.max' => 'Đánh giá quá dài',
                    'chitiet_edit.required' => 'Chi tiết không được để trống',
                    'giaban_edit.required' => 'Giá không được để trống',
                    'soluong_edit.required' => 'Số lượng không được để trống'
                ]
            );

        $sanpham->TenSP = $req->tensp_edit;
        $sanpham->id_Loai = $req->danhmuc_edit;
        $sanpham->id_NSX = $req->nsx_edit;
        $sanpham->DanhGia = $req->danhgia_edit;
        $sanpham->ChiTiet = $req->chitiet_edit;
        $sanpham->Gia = $req->giaban_edit;
        $sanpham->SoLuong = $req->soluong_edit;

        if ($sanpham->save()) {
            $last_id_inserted = $sanpham->id;

            $link_folder = '/upload/sanpham/'. $last_id_inserted;
            $path = public_path($link_folder);
            
            function del_add_file ($req, $path, $nameFileInput, $nameFile, $extension, $width, $height) {
                if ($req->hasFile($nameFileInput)) {
                    
                    File::delete($path.'/'.$nameFile.'.'.$extension);
                    //get file
                    $file = $req->file($nameFileInput);
                    //resize ảnh
                    $resizeImage = Image::make($file)->resize($width, $height);
                    // upload
                    $resizeImage->save($path.'/'.$nameFile.'.'.$extension);
                }
            }

            del_add_file($req, $path, 'anhlon_edit', 'big', 'jpg', 350, 350);
            del_add_file($req, $path, 'anhnho_edit', 'small', 'jpg', 200, 200);

            return redirect('admin/sanpham/edit')->with('notification', 'Chỉnh sửa thành công.');
        } else {
            return view('errors.503');
        }
    }

    public function getDelete () {
        $list_sanpham = sanpham::all();
        $list_nsx = nsx::all();
        $list_danhmuc = danhmuc::all();

        $nsx_arr = [];
        foreach ($list_nsx as $nsx) {
            $nsx_arr[$nsx->id] = $nsx->TenNSX;
        }

        $danhmuc_arr = [];
        foreach ($list_danhmuc as $danhmuc) {
            $danhmuc_arr[$danhmuc->id] = $danhmuc->TenLoai;
        }

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

        return view('admin.sanpham.delete', ['list_sanpham' => $sanpham]);
    }

    public function Delete ($id) {
        $sanpham = sanpham::find($id);
        $sanpham->Trangthai = 0;
        if ($sanpham->save()) {
            return redirect('admin/sanpham/delete');
        } else {
            return view('errors.503');
        }
    }

    public function KhoiPhuc ($id) {
        $sanpham = sanpham::find($id);
        $sanpham->Trangthai = 1;
        $sanpham->save();
        if ($sanpham->save()) {
            return redirect('admin/sanpham/delete');
        } else {
            return view('errors.503');
        }
    }
}

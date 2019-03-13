<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\sanpham;
use App\Http\Models\nsx;
use App\Http\Models\danhmuc;
use App\Http\Models\donhang;
use App\Http\Models\ct_donhang;
use App\Http\Models\User;
use Auth;
use App\Http\Requests;


class ajax_Controller extends Controller
{
    //
    public function LoadEdit_Sanpham (Request $req) {
        $sanpham = sanpham::find($req->id);
        $nsx = nsx::all();
        $danhmuc = danhmuc::all();

        $strNSX_html = "";
        $strNSX_html = loadHTML($strNSX_html, $nsx, $sanpham, 'id_NSX', 'TenNSX');

        $strDanhmuc_html = "";
        $strDanhmuc_html = loadHTML($strDanhmuc_html, $danhmuc, $sanpham, 'id_Loai', 'TenLoai');

        echo json_encode(array($sanpham, $strNSX_html, $strDanhmuc_html));
    }

    public function LoadEdit_User (Request $req) {
        $user = User::find($req->id);
        echo $user;
    }

    public function updateTrangthai (Request $req) {
        $donhang = donhang::find($req->id_dh);
        $donhang->TrangThai = $req->trangthai;
        if ($donhang->save()) {
            echo json_encode(array(1, $donhang->TrangThai));
        } else {
            echo json_encode(array(0, $donhang->TrangThai));
        }
    }

    // gio hàng
    public function themSP_giohang (Request $req) {
        $sanpham = sanpham::find($req->id_sp);
        $ten_sp = $sanpham->TenSP;
        $gia_sp = $sanpham->Gia;

        if ($req->session()->has('giohang')) {
            $giohang_old = $req->session()->get('giohang');

            if (array_key_exists($req->id_sp, $giohang_old)) {
                $soluong_old = $giohang_old[$req->id_sp]['so_luong'];
                $giohang_old[$req->id_sp]['so_luong'] = (int)$soluong_old + $req->soluong_sp;
            } else {
                $giohang_old[$req->id_sp] = [
                    'ten_sp' => $ten_sp,
                    'gia_sp' => $gia_sp,
                    'so_luong' => (int)$req->soluong_sp,
                ];
            }
            $req->session()->put('giohang', $giohang_old);
            $tongsl = TongSP_giohang($req);
            $tongtien = TongTien_giohang($req);
            if ($tongsl == 0) {
                $req->session()->forget('giohang');
                $req->session()->forget('tong_sp_giohang');
                $req->session()->forget('tongtien_giohang');
            }
            echo json_encode(array($tongtien, $tongsl));
        } else {
            $giohang = [
                $req->id_sp => [
                    'ten_sp' => $ten_sp,
                    'gia_sp' => $gia_sp,
                    'so_luong' => (int)$req->soluong_sp,
                ]
            ];
            $req->session()->put('giohang', $giohang);
            $tongsl = TongSP_giohang($req);
            $tongtien = TongTien_giohang($req);
            if ($tongsl == 0) {
                $req->session()->forget('giohang');
                $req->session()->forget('tong_sp_giohang');
                $req->session()->forget('tongtien_giohang');
            }
            echo json_encode(array($tongtien, $tongsl));
        }
    }

    public function capNhat_giohang (Request $req) {
        if ($req->session()->has('giohang')) {
            $giohang = $req->session()->get('giohang');
            if (array_key_exists($req->id_sp, $giohang)) {
                if ($req->soluong_new == 0) {
                    unset($giohang[$req->id_sp]);
                    $req->session()->put('giohang', $giohang);
                    $gia_new = -1; // xóa luôn <tr>
                } else {
                    $giohang[$req->id_sp]['so_luong'] = (int)$req->soluong_new;
                    $req->session()->put('giohang', $giohang);

                    // giá mới hiển thị trên view
                    $gia_new = $giohang[$req->id_sp]['so_luong'] * $giohang[$req->id_sp]['gia_sp'];
                }

                $tongsl = TongSP_giohang($req);
                $tongtien = TongTien_giohang($req);
                if ($tongsl == 0) {
                    $req->session()->forget('giohang');
                    $req->session()->forget('tong_sp_giohang');
                    $req->session()->forget('tongtien_giohang');
                }
                echo json_encode(array($gia_new, $tongtien, $tongsl));
            }
        }
    }

    public function xoa1spGiohang (Request $req) {
        if ($req->session()->has('giohang')) {
            $giohang = $req->session()->get('giohang');
            if (array_key_exists($req->id_sp, $giohang)) {
                unset($giohang[$req->id_sp]);
                $req->session()->put('giohang', $giohang);
                $tongsl = TongSP_giohang($req);
                $tongtien = TongTien_giohang($req);
                if ($tongsl == 0) {
                    $req->session()->forget('giohang');
                    $req->session()->forget('tong_sp_giohang');
                    $req->session()->forget('tongtien_giohang');
                }
                echo json_encode(array($tongtien, $tongsl));
            }
        }
    }

    public function xoaGiohang (Request $req) {
        if ($req->session()->has('giohang')) {
            $req->session()->forget('giohang');
            $req->session()->forget('tong_sp_giohang');
            $req->session()->forget('tongtien_giohang');
        }
    }

    public function ThanhToan (Request $req) {
        if ($req->session()->has('tongtien_giohang')) {
            if (Auth::check()) {
                $donhang = new donhang;
                $donhang->NgayLap = date('Y-m-d H:i:s', time());
                $donhang->id_user = Auth::user()->id;
                $donhang->TongTien = (int)$req->session()->get('tongtien_giohang');
                $donhang->TrangThai = 'chưa giao';
                if ($donhang->save()) {
                    $giohang = $req->session()->get('giohang');
                    $temp = 0;
                    foreach ($giohang as $masp => $thongtinsp) {
                        $sanpham = sanpham::find($masp);

                        $ct_donhang = new ct_donhang;
                        $ct_donhang->id_SP = $masp;
                        $ct_donhang->id_DH = $donhang->id;
                        // so sánh vs số lượng còn lại trong kho
                        if (($sanpham->SoLuong - $thongtinsp['so_luong']) < 0 ) {
                            $ct_donhang->Soluong = $sanpham->SoLuong;
                            $sanpham->SoLuong = 0;
                        } else {
                            $ct_donhang->Soluong = $thongtinsp['so_luong'];
                            $sanpham->SoLuong = $sanpham->SoLuong - $thongtinsp['so_luong'];
                        }
                        $ct_donhang->GiaSP = $thongtinsp['gia_sp'];
                        $ct_donhang->ThanhTien = $thongtinsp['so_luong'] * $thongtinsp['gia_sp'];
                        if ($ct_donhang->save()) {
                            if ($sanpham->save()) {
                                $temp += 0;
                            } else {
                                $temp += 1;
                            }
                        } else {
                            $temp += 1;
                        }     
                    }
                    if ($temp == 0) {
                        $req->session()->forget('giohang');
                        $req->session()->forget('tong_sp_giohang');
                        $req->session()->forget('tongtien_giohang');
                        echo 1;
                    } else {
                        echo 0;
                    }
                }
            }
        }
    }

    public function test (Request $req) {
        // if ($req->session()->has('giohang')) {
        //         $test = $req->session()->get('giohang');
        //         echo var_dump($test);
        //     }
        return $req->path();
    }
}

function loadHTML ($str_html, $var1, $table, $id_var1, $name_var1) {
    foreach($var1 as $n)
    {
        if($n->id == $table->$id_var1) {
            $str_html .= "<option value='".$n->id."' selected >".$n->$name_var1."</option>";    
        } else {
            $str_html .= "<option value='".$n->id."'>".$n->$name_var1."</option>";
        }
    }
    return $str_html;
}

function TongSP_giohang ($req) {
    if ($req->session()->has('giohang')) {
        $giohang = $req->session()->get('giohang');
        $tong = 0;    
        foreach($giohang as $masp => $thongtinsp) {
            $tong += $thongtinsp['so_luong'];
        }
        $req->session()->put('tong_sp_giohang', $tong);
        return $tong;
    }
}

function TongTien_giohang ($req) {
    if ($req->session()->has('giohang')) {
        $giohang = $req->session()->get('giohang');
        $tong = 0;    
        foreach($giohang as $masp => $thongtinsp) {
            $tong += $thongtinsp['so_luong']*$thongtinsp['gia_sp'];
        }
        $req->session()->put('tongtien_giohang', $tong);
        return $tong;
    }
}

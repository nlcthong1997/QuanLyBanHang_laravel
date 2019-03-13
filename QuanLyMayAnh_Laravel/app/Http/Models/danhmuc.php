<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class danhmuc extends Model
{
    //
    // kết nối tới bảng Nsx trong DB
    protected $table = 'danhmuc';
    // tắt chức năng tự động 'create_at' và 'update_at'
    public $timestamps = false;

    public function sanpham () {
        return $this->hasMany('App\Http\Models\sanpham', 'id_Loai', 'id');
    }

    public function ct_donhang () {
        return $this->hasManyThrough('App\Http\Models\ct_donhang', 'App\Http\Models\sanpham', 'id_Loai', 'id_SP', 'id');
    }
}

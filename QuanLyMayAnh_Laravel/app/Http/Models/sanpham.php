<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    //
    protected $table = 'sanpham';
    // tắt chức năng tự động 'create_at' và 'update_at'
    public $timestamps = false;

    public function danhmuc () {
        return $this->belongsTo('App\Http\Models\danhmuc', 'id_Loai', 'id');
    }

    public function nsx () {
        return $this->belongsTo('App\Http\Models\nsx', 'id_NSX', 'id');
    }

    public function ct_donhang () {
        return $this->hasMany('App\Http\Models\ct_donhang', 'id_SP', 'id');
    }
}

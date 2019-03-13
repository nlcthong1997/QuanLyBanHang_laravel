<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ct_donhang extends Model
{
    //
    protected $table = 'ct_donhang';
    // tắt chức năng tự động 'create_at' và 'update_at'
    public $timestamps = false;

    public function sanpham () {
        return $this->belongsTo('App\Http\Models\sanpham', 'id_SP', 'id');
    }

    public function donhang () {
        return $this->belongsTo('App\Http\Models\donhang', 'id_DH', 'id');
    }
}

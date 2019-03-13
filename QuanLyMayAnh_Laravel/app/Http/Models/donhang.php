<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class donhang extends Model
{
    //
    protected $table = 'donhang';
    // tắt chức năng tự động 'create_at' và 'update_at'
    public $timestamps = false;

    public function ct_donhang () {
        return $this->hasMany('App\Http\Models\ct_donhang', 'id_DH', 'id');
    }

    public function users () {
        return $this->belongsTo('App\Http\Models\User', 'id_user', 'id');
    }
}

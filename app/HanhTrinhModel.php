<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HanhTrinhModel extends Model
{
    protected $table = "hanhtrinh";

    public function lichtrinh()
    {
        return $this->belongsTo('App\LichTrinhModel', 'lichtrinh_id', 'id');
    }

    public function diadiem()
    {
        return $this->hasOne('App\DiaDiemModel', 'diadiem_id', 'id');
    }
}

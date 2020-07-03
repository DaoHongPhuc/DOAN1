<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailDDModel extends Model
{
    protected $table = "detail_dd";

    public function diadiem()
    {
        return $this->belongsTo('App\DiaDiemModel', 'diadiem_id', 'id');
    }
}

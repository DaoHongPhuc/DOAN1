<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaDiemModel extends Model
{
    protected $table = "diadiem";

    public function hanhtrinh()
    {
        return $this->belongsTo('App\HanhTrinhModel', 'diadiem_id', 'id');
    }
}

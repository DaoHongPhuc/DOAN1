<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaDiemModel extends Model
{
    protected $table = "diadiem";
    public function dtdiadiem()
    {
        return $this->hasMany('App\DetailDDModel', 'diadiem_id', 'id');
    }
}

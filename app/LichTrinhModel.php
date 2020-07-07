<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LichTrinhModel extends Model
{
    protected $table = "lichtrinh";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function hanhtrinh()
    {
        return $this->hasMany('App\HanhTrinhModel', 'lichtrinh_id', 'id');
    }
    
}

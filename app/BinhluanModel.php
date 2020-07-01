<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinhluanModel extends Model
{
    protected $table = "binhluan";

    public function customer()
    {
        return $this->belongsTo('App\CustomerModel', 'cus_id', 'id');
    }
}

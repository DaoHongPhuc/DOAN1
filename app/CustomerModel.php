<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = "customer";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tour()
    {
        return $this->hasMany('App\TourModel', 'cus_id', 'id');
    }

    public function binhluan()
    {
        return $this->hasMany('App\BinhluanModel', 'cus_id', 'id');
    }

    public function report()
    {
        return $this->hasMany('App\ReportModel', 'cus_id', 'id');
    }
}

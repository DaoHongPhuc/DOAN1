<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourModel extends Model
{
    protected $table = "tours";

    protected $dates = [
        'present','timepublic','created_at','updated_at',
    ];

    public function customer()
    {
        return $this->belongsTo('App\CustomerModel', 'cus_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    protected $table = "report";
    
    public function customer()
    {
        return $this->belongsTo('App\CustomerModel', 'cus_id', 'id');
    }
}

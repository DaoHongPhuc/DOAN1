<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobModel extends Model
{
    protected $table = "job";

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
}

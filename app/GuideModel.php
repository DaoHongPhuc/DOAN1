<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuideModel extends Model
{
    protected $table = "guide";
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function job()
    {
        return $this->hasMany('App\JobModel', 'guide_id', 'id');
    }
}

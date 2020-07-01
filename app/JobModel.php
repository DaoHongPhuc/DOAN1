<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobModel extends Model
{
    protected $table = "jobs";

    public function guide()
    {
        return $this->belongsTo('App\GuideModel', 'guide_id', 'id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class media extends Model
{
    protected $guarded=[];
    public function post()
    {
        return $this->belongsTo('App\post');
    }
}

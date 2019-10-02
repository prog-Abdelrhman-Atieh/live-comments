<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $guarded=[];
    public function post(){
        return $this->belongsTo('App\post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments(){
        return $this->hasMany('App\comment');
    }
}

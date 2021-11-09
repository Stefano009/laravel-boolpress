<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts(){
        return $this->belongsToMany('App\Post');
        //belongsToMany  means that this is subordinate, and have a relation of nany to many (many post 1 category)
    }
}

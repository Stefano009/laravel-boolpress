<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    protected $fillable = ['name', 'slug'];

    public function posts() {
        return $this->hasMany('App\Post');
        //this means that category has a master position in relation with posts and it mean that 1 category may have many posts
    }
}

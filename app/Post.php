<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'category_id'];

    public function category(){
        return $this->belongsTo('App\Category');
        //belongsTo  means that this is subordinate, and have a relation of 1 to many (many post 1 category)
    }
}

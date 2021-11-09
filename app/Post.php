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
    public function tags(){
        return $this->belongsToMany('App\Tag');
        //belongsToMany  means that this is subordinate, and have a relation of nany to many (many post 1 category)
    }
}
// here i am stating that my model has a n to 1 relation subordinate to category in fact it belongs to it!

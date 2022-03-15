<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    // relazione 1 a molti -> 1 categoria a molti posts
    public function posts(){
        return $this->hasMany('App\Post');
    }
}

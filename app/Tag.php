<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model

// relazione molti a molti -> più post a più tags
{
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

}

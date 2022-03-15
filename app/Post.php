<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
    ];

    //relazione 1 a molti -> 1 utente a molti posts
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // relazione 1 a 1 -> 1 post a 1 categoria
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}

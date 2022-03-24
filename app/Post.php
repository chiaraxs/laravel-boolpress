<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;          // -> cancella i post ma restano comunque in memoria nel db (da attivare in Admin/PostController - riga 192)
    
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

    // relazione molti a molti -> più post a più tags
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

}

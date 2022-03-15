<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoUser extends Model
{
    // relazione 1 a 1 -> 1 utente a 1 infoUser
    public function user(){
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    //
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function shop(){
        return $this->belongsTo('App\Shop');
    }
}

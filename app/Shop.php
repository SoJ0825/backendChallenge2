<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    public function merchandise() {
        return $this->hasMany('App\Merchandise');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'order_id', 'user_id', 'merchandise', 'count', 'unit_price'
    ];

    protected $hidden = [
        'serial_number', 'user_id', 'created_at', 'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}

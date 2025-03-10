<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_orders';  // Custom primary key name

    protected $fillable = ['users_id', 'events', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}

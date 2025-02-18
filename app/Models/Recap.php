<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recap extends Model
{
    protected $fillable = [
        'users_id', 'orders_id', 'event', 'profile', 'name',
        'nip', 'phone', 'total_item', 'detail_items', 'date'
    ];

    protected $casts = [
        'detail_items' => 'array', // Untuk menyimpan JSON sebagai array
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }
}

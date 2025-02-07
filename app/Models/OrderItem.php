<?php

namespace App\Models;

use App\Models\User;
use App\Models\Inventory;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $table = 'order_items';  // Explicitly define the table name if needed
    protected $primaryKey = 'id_order_items';  // Custom primary key name


    // The attributes that are mass assignable.
    protected $fillable = ['users_id', 'inventories_id', 'quantity', 'status'];

    // Define the relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function inventory()
    {
        return $this->belongsTo(inventory::class, 'inventories_id');
    }
}

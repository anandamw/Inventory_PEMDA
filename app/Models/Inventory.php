<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_name',
        'img_item',
        'quantity',
        'code_item',
        'item_name'
    ];

    protected $table = 'inventories';
    protected $primaryKey = 'id_inventories';

    // Define the relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'inventories_id');
    }
}

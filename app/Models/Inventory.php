<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_name',
        'img_product',
        'quantity',
        'code_item'
    ];

    protected $table = 'inventories';
    protected $primaryKey = 'id_inventories';

    // Define the relationship with OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'inventories_id');
    }
}

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
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{

    protected $guarded = [''];
    protected $primaryKey = 'inventories_id';

    protected $table = 'order_items';
}

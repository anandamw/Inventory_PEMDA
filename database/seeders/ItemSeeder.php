<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code_item' => '123456',
                'item_name' => 'Laptop',
                'img_item' => null,
                'quantity' => 200,
            ],
            [
                'code_item' => '123457',
                'item_name' => 'Kabel',
                'img_item' => null,
                'quantity' => 200,
            ],
            [
                'code_item' => '123458',
                'item_name' => 'Server',
                'img_item' => null,
                'quantity' => 400,
            ],
            [
                'code_item' => '123459',
                'item_name' => 'Monitor',
                'img_item' => null,
                'quantity' => 400,
            ],
            [
                'code_item' => '123460',
                'item_name' => 'Keyboard',
                'img_item' => null,
                'quantity' => 500,
            ],

        ];


        foreach ($data as $item) {
            Inventory::create($item);
        }

        

      
    }
    
}

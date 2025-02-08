<?php

namespace Database\Seeders;

use App\Models\Inventory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'quantity' => 6,
            ],
            [
                'code_item' => '123457',
                'item_name' => 'Kabel',
                'img_item' => null,
                'quantity' => 20,
            ],
            [
                'code_item' => '123458',
                'item_name' => 'Server',
                'img_item' => null,
                'quantity' => 4,
            ],
            [
                'code_item' => '123459',
                'item_name' => 'Monitor',
                'img_item' => null,
                'quantity' => 40,
            ],
            [
                'code_item' => '123460',
                'item_name' => 'Keyboard',
                'img_item' => null,
                'quantity' => 50,
            ],

        ];


        foreach ($data as $item) {
            Inventory::create($item);
        }
    }
}

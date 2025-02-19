<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert Orders
        DB::table('orders')->insert([
            [
                'users_id' => 1,
                'events' => 'Meeting A',
                'phone' => '081234567890',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => now()
            ],
            [
                'users_id' => 2,
                'events' => 'Workshop B',
                'phone' => '081298765432',
                'created_at' => Carbon::now()->subWeeks(1),
                'updated_at' => now()
            ],
            [
                'users_id' => 1,
                'events' => 'Conference C',
                'phone' => '081212345678',
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => now()
            ],
            [
                'users_id' => 2,
                'events' => 'Seminar D',
                'phone' => '081278945612',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => now()
            ],
            [
                'users_id' => 1,
                'events' => 'Webinar E',
                'phone' => '081234998877',
                'created_at' => Carbon::now()->subWeeks(2),
                'updated_at' => now()
            ],
        ]);

        // Insert Order Items
        DB::table('order_items')->insert([
            [
                'users_id' => 1,
                'inventories_id' => 1,
                'orders_id' => 1,
                'quantity' => 2,
                'status' => 'success',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => now()
            ],
            [
                'users_id' => 2,
                'inventories_id' => 2,
                'orders_id' => 2,
                'quantity' => 1,
                'status' => 'success',
                'created_at' => Carbon::now()->subWeeks(1),
                'updated_at' => now()
            ],
            [
                'users_id' => 1,
                'inventories_id' => 1,
                'orders_id' => 3,
                'quantity' => 3,
                'status' => 'success',
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => now()
            ],
            [
                'users_id' => 2,
                'inventories_id' => 3,
                'orders_id' => 4,
                'quantity' => 5,
                'status' => 'success',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => now()
            ],
            [
                'users_id' => 1,
                'inventories_id' => 2,
                'orders_id' => 5,
                'quantity' => 4,
                'status' => 'success',
                'created_at' => Carbon::now()->subWeeks(2),
                'updated_at' => now()
            ],
        ]);
    }
}
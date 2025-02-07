<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger("id_order_items")->autoIncrement();


            $table->foreignId('users_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger("inventories_id");
            $table->foreign("inventories_id")->references("id_inventories")->on("inventories");

            $table->integer('quantity');

            $table->enum('status', ['pending', 'success', 'failed', 'cancelled', 'process'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

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
        Schema::create('recaps', function (Blueprint $table) {
            $table->unsignedBigInteger('id_recaps')->autoIncrement();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('orders_id');
            $table->foreign('orders_id')->references('id_orders')->on('orders')->onDelete('cascade');
            $table->string('event');
            $table->string('profile')->nullable();
            $table->string('name');
            $table->string('nip', 15);
            $table->string('phone');
            $table->integer('total_item');
            $table->json('detail_items'); // Menyimpan detail item dalam JSON
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recaps');
    }
};

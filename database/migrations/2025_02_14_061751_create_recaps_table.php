<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recaps', function (Blueprint $table) {
            $table->unsignedBigInteger('id_recaps')->autoIncrement();
         
            $table->unsignedBigInteger('orders_id');
            $table->foreign('orders_id')->references('id_orders')->on('orders');
            
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->text('details');
             $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recaps');
    }
};

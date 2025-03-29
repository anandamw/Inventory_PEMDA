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
        Schema::create('instansis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_instansi')->autoIncrement();
            $table->string('nama_instansi');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();


            $table->string('profile')->nullable();
            $table->string('password');

            $table->string('nip', 15)->unique();

            $table->unsignedBigInteger('id_instansi')->nullable();
            $table->foreign('id_instansi')->references('id_instansi')->on('instansis')->onDelete('set null');

            $table->enum('role', ['admin', 'opd', 'team'])->default('opd');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('repairs', function (Blueprint $table) {
            $table->id('id_repair');
            $table->unsignedBigInteger('user_id'); // user yang melaporkan
            $table->unsignedBigInteger('admin_id')->nullable(); // admin yang menjadwalkan
            $table->text('repair'); // deskripsi perbaikan
            $table->date('scheduled_date')->nullable(); // jadwal perbaikan
            $table->unsignedBigInteger('team_id')->nullable(); // Team yang ditugaskan
            $table->enum('status', ['pending', 'scheduled', 'completed', 'failed', 'expired'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('team_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('repair_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('repair_id');
            $table->unsignedBigInteger('user_id'); // ini user team
            $table->string('status')->nullable();
            $table->string('repair')->nullable();


            $table->integer('rating')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->foreign('repair_id')->references('id_repair')->on('repairs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instansis');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

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
        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tabungan_id')->constrained('tabungan');
            $table->integer('total_harga');
            $table->integer('bobot');
            $table->integer('nominal')->nullable();
            $table->foreignId('jenismutasi_id')->constrained('jenismutasi');
            $table->foreignId('admin_id')->nullable()->constrained('users');
            $table->boolean('hapusdata')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi');
    }
};

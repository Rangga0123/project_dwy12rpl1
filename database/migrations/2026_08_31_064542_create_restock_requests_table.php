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
        Schema::create('restock_requests', function (Blueprint $table) {
            $table->id();

            // User yang mengajukan restock
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Buku yang diajukan untuk restock
            $table->foreignId('restock_id')
                ->constrained('restocks')
                ->cascadeOnDelete();

            // Jumlah buku yang diminta
            $table->unsignedInteger('jumlah');

            // Alasan pengajuan
            $table->text('alasan')->nullable();

            // Status pengajuan
            $table->enum('status', [
                'menunggu',
                'disetujui',
                'ditolak'
            ])->default('menunggu');

            // Catatan dari admin
            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restock_requests');
    }
};
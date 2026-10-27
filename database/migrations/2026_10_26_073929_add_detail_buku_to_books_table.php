<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('penerbit')->nullable();
            $table->string('pengarang')->nullable();
            $table->string('tahun_terbit', 4)->nullable();
            $table->string('tahun_bantuan', 4)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn([
                'penerbit',
                'pengarang',
                'tahun_terbit',
                'tahun_bantuan',
            ]);
        });
    }
};
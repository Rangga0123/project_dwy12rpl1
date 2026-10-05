<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restock_requests', function (Blueprint $table) {
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('restock_requests', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropColumn('book_id');
        });
    }
};
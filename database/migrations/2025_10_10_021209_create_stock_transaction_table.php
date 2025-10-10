<?php
// database/migrations/xxxx_create_stock_transactions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('product_id')->constrained()->onDelete('restrict');
            $table->enum('type', ['in', 'out']); // in = barang masuk, out = barang keluar
            $table->integer('quantity');
            $table->integer('stock_before'); // stok sebelum transaksi
            $table->integer('stock_after'); // stok setelah transaksi
            $table->text('notes')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('restrict'); // user yang melakukan transaksi
            $table->timestamp('transaction_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};

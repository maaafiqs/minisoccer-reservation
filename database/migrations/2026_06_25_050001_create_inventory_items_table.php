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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->unique(); // Nomor Barang
            $table->foreignId('inventory_category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('brand')->nullable(); // Merk
            $table->integer('quantity')->default(0);
            $table->enum('status', ['baik', 'rusak'])->default('baik');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};

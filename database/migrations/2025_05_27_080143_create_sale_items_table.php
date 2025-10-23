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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();

            // Hangi satışa ait
            $table->foreignId('sale_id')->constrained('sales')->onDelete('cascade');

            // Hangi ürün satıldı
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            // Kaç adet satıldı
            $table->integer('quantity');

            // Birim fiyatı
            $table->decimal('price', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};

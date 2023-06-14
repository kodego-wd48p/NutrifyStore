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
        Schema::table('cart_product', function (Blueprint $table) {
            $table->dropForeign('cart_product_cart_id_foreign');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade')->onUpdate('no action');
            $table->dropForeign('cart_product_product_id_foreign');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_product', function (Blueprint $table) {
            $table->dropForeign('cart_product_cart_id_foreign');
            $table->foreign('cart_id')->references('id')->on('carts');
            $table->dropForeign('cart_product_product_id_foreign');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }
};

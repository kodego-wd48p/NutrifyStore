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
        Schema::table('sale_product', function (Blueprint $table) {
            $table->dropForeign('sale_product_product_id_foreign');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('no action');
            $table->dropForeign('sale_product_sale_id_foreign');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_product', function (Blueprint $table) {
            $table->dropForeign('sale_product_product_id_foreign');
            $table->foreign('product_id')->references('id')->on('products');
            $table->dropForeign('sale_product_sale_id_foreign');
            $table->foreign('sale_id')->references('id')->on('sales');
        });
    }
};

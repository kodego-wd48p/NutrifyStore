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
        Schema::table('purchase_product', function (Blueprint $table) {
            $table->dropForeign('purchase_product_product_id_foreign');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('no action');
            $table->dropForeign('purchase_product_purchase_id_foreign');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_product', function (Blueprint $table) {
            $table->dropForeign('purchase_product_product_id_foreign');
            $table->foreign('product_id')->references('id')->on('products');
            $table->dropForeign('purchase_product_purchase_id_foreign');
            $table->foreign('purchase_id')->references('id')->on('purchases');
        });
    }
};

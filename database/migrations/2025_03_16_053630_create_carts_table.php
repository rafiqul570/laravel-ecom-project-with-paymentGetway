<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->string('product_name');
        $table->string('product_img');
        $table->string('product_color')->nullable();
        $table->string('product_size')->nullable();
        $table->integer('product_quantity');
        $table->decimal('discount_price', 10, 2)->nullable()->change();
        $table->decimal('product_price', 10, 2)->nullable()->change();
        $table->decimal('shippingCost', 10, 2)->default(0);
        $table->decimal('total_price', 10, 2);
        $table->timestamps();
       
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};

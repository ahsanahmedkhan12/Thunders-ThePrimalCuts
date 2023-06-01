<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailAddOnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail_add_ons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_detail_id');
            $table->uuid('add_on_menu_id');
            $table->string('quantity');
            $table->string('subtotal');  
            $table->timestamps();
            $table->foreign('order_detail_id')->references('id')->on('order_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('add_on_menu_id')->references('id')->on('add_on_menus')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail_add_ons');
    }
}

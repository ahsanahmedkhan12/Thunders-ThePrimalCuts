<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddOnMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_on_menus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('menu_id')->nullable();
            $table->string('name', 150)->nullable();
            $table->string('price')->nullable();
            $table->string('position');
            $table->timestamps();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_on_menus');
    }
}

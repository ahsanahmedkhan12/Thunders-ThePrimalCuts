<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserExtraDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_extra_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id'); 
            $table->string('country', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_extra_details');
    }
}

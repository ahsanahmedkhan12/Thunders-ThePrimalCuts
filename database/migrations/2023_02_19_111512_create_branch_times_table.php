<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_times', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('branch_id'); 
            $table->uuid('weekday_id'); 
            $table->string('start_time');
            $table->string('stop_time');
            $table->string('position');
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('weekday_id')->references('id')->on('week_days')->onDelete('cascade')->onUpdate('cascade');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_times');
    }
}

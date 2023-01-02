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
        Schema::create('requests_inspections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requests_form_id');
            $table->unsignedBigInteger('inspections_id');
            $table->timestamps();
            
            $table->foreign('requests_form_id')->references('id')->on('requests')->onDelete('cascade');
            $table->foreign('inspections_id')->references('id')->on('inspections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests_inspections');
    }
};

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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('corporate_name');
            $table->text('corporate_address');
            $table->integer('corporate_budget');
            $table->string('corporate_owner');
            $table->string('corporate_mobile');
            $table->string('corporate_phone');
            $table->text('corporate_email');
            $table->longText('client_extra');
            $table->integer('status')->default(1);
            $table->integer('handler')->nullable();
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
        Schema::dropIfExists('requests');
    }
};

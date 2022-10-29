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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barber');
            $table->string('avatar_url');
            $table->string('name');
            $table->integer('id_service');
            $table->string('name_service');
            $table->integer('price_service');
            $table->integer('selectedYear');
            $table->integer('selectedMonth');
            $table->integer('selectedDay');
            $table->string('selectedHour');
            $table->string('user_id');
            $table->string('user_name');
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
        Schema::dropIfExists('appointments');
    }
};

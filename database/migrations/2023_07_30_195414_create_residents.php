<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->integer('id_building');
            $table->integer('id_master');
            $table->char('num_apt', 90);
            $table->text('name');
            $table->text('email');
            $table->text('password');
            $table->integer('qtd_pets');
            $table->integer('qtd_cars');
            $table->integer('qtd_childrens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residents');
    }
}

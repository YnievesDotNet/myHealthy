<?php

use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Creates the users table
        Schema::create('countries', function ($table) {
            $table->increments('id')->index();
            $table->integer('id_country');
            $table->integer('languaje_id');
            $table->string('name', 255)->nullable();
            $table->string('lat', 255)->nullable();
            $table->string('long', 255)->nullable();
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('countries');
    }

}

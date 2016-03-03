<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('games')->nullable();
            $table->string('games_details')->nullable();
            $table->string('art')->nullable();
            $table->string('art_details')->nullable();
            $table->string('music')->nullable();
            $table->string('music_details')->nullable();
            $table->string('building_stuff')->nullable();
            $table->string('building_stuff_details')->nullable();
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
        Schema::drop('user_details');
    }
}

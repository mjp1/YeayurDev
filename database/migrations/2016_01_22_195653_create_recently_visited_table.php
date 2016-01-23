<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecentlyVisitedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recently_visited', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id');
            $table->integer('profile_id');
            $table->integer('times_visited');
            $table->timestamp('last_visit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recently_visited');
    }
}

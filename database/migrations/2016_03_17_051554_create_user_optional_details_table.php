<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOptionalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_optional_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('about_me')->nullable();
            $table->text('system_specs')->nullable();
            $table->text('stream_schedule')->nullable();
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_optional_details');
    }
}

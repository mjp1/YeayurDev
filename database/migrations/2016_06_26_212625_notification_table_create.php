<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificationTableCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('notification_name');
            $table->timestamps();
        });

        DB::table('notifications')->insert([
            ['notification_name' => 'Follow'],
            ['notification_name' => 'Post'],
            ['notification_name' => 'Like'],
            ['notification_name' => 'Live'],
            ['notification_name' => 'Stream'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('notifications');
    }
}

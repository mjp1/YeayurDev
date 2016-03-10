<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_name');
            $table->timestamps();
        });

        DB::table('type')->insert([
            ['type_name' => 'Games'],
            ['type_name' => 'Art'],
            ['type_name' => 'Music'],
            ['type_name' => 'Building Stuff'],
            ['type_name' => 'Educational'],
        ]);

                   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('type');
    }
}

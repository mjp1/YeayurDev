<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAlgoliaIdField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('algolia_id')->index();
        });

        Schema::table('fans', function($table) {
            $table->string('algolia_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('algolia_id');
        });

        Schema::table('fans', function($table) {
            $table->dropColumn('algolia_id');
        });
    }
}

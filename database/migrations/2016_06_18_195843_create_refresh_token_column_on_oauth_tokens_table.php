<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefreshTokenColumnOnOauthTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oauth_tokens', function($table) {
            $table->string('Twitch_refresh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oauth_tokens', function($table) {
            $table->dropColumn('Twitch_refresh');
        });
    }
}

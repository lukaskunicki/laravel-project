<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function($table) {
            $table->boolean('is_active');
        });
        Schema::table('clubs', function($table) {
            $table->boolean('is_active');
        });
        Schema::table('nationalities', function($table) {
            $table->boolean('is_active');
        });
        Schema::table('positions', function($table) {
            $table->boolean('is_active');
        });
        Schema::table('leagues', function($table) {
            $table->boolean('is_active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

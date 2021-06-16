<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->string('slug')->unique();
        });

        Schema::table('steps', function (Blueprint $table) {
            $table->string('slug')->unique();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->string('slug')->unique();
        });

        Schema::table('workflows', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('steps', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('workflows', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}

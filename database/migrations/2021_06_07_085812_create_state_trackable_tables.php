<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateTrackableTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_trackables', function (Blueprint $table) {
            $table->id();
            $table->integer('state_track_id');
            $table->integer('state_trackable_id');
            $table->string('state_trackable_type');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('state_track', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('type');
            $table->string('note');
            $table->jsonb('data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_trackable');
        Schema::dropIfExists('state_track');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskSplitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_splits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('og_task_id');
            $table->unsignedBigInteger('og_step_id')->nullable();
            $table->unsignedBigInteger('dest_task_id');
            $table->softDeletes();
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
        Schema::dropIfExists('task_splits');
    }
}

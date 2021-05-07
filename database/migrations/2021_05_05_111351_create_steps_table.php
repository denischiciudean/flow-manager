<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->comment("is GUI or BACKGROUND");
            $table->string('component')->comment("Can either be the UI component name OR it can be a invokable class for the background type");
            $table->jsonb('validation')->comment("Validation refers to either the data that the GUI has to collect or the rezolution or the background job");
            $table->boolean('reusable')->default(true);
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
        Schema::dropIfExists('steps');
    }
}

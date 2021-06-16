<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DepartmentIdNullableOnRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('roles', fn(Blueprint $table) => $table->unsignedBigInteger('department_id')->nullable()->change());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('roles', fn(Blueprint $table) => $table->dropColumn('department_id'));
    }
}

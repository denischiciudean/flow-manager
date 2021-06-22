<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameReplyableTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('replyable', function (Blueprint $table) {
            $table->renameColumn('repliable_id', 'replyable_id');
        });

        Schema::rename('replyable', 'replyables');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('replyables', 'replyable');
    }
}

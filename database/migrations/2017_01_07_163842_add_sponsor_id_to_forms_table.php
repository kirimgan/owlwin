<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSponsorIdToFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicationcv_form_entries', function (Blueprint $table) {
            $table->integer('sponsor_id')->nullable()->unsigned();
            $table->foreign('sponsor_id')
              ->references('id')->on('sponsors')
              ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicationcv_form_entries', function (Blueprint $table) {
            $table->dropColumn(['sponsor_id']);
        });
    }
}

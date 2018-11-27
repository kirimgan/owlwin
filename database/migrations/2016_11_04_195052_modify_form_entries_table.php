<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyFormEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicationcv_form_entries', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->string('pdf_form_name', 255);
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
            $table->dropColumn(array('user_id', 'pdf_form_name'));
        });//
    }
}

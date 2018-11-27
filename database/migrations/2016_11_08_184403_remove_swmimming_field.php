<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSwmimmingField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('applicationcv_form_entries', function (Blueprint $table) {
            $table->dropColumn(
                array(
                    'swimming'
                )
            );
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
            $table->string('swimming', 255);
        });//
    }
}

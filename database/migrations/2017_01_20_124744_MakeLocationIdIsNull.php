<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLocationIdIsNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicationcv_form_entries', function (Blueprint $table) {
            DB::statement('ALTER TABLE applicationcv_form_entries CHANGE location_id location_id INT(11)  NULL;');
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
            DB::statement('ALTER TABLE applicationcv_form_entries CHANGE location_id location_id INT(11) NOT NULL;');
        });
    }
}

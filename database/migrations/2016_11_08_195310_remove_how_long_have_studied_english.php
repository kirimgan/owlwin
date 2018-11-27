<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveHowLongHaveStudiedEnglish extends Migration
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
                    'studyingEn'
                )
            );
            $table->text('workExperience')->change();
            $table->text('skills')->change();
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
            $table->string('studyingEn', 255);
            $table->string('workExperience')->change();
            $table->string('skills')->change();
        });
    }
}

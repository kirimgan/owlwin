<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAditionalFieldsToEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicationcv_form_entries', function (Blueprint $table) {
            $table->string('country', 255);
            $table->string('address', 500);
            $table->string('language', 255);
            $table->string('gender', 255);
            $table->string('dateOfBirth', 255);
            $table->string('email', 255);
            $table->string('skype', 255);
            $table->string('phoneHome', 255);
            $table->string('phoneMobile', 255);
            $table->string('englishLevel', 255);
            $table->string('height', 255);
            $table->string('size', 255);
            $table->string('weight', 255);
            $table->string('education', 255);
            $table->string('study', 255);
            $table->string('earliestDate', 255);
            $table->string('latestDate', 255);
            $table->string('swimming', 255);
            $table->string('drivingExperience', 255);
            $table->string('studyingEn', 255);
            $table->string('otherLanguage', 255);
            $table->string('beforeUS', 255);
            $table->string('workExperience', 2000);
            $table->string('skills', 2000);
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
            $table->dropColumn(
                array(
                    'country',
                    'address',
                    'language',
                    'gender',
                    'dateOfBirth',
                    'email',
                    'skype',
                    'phoneHome',
                    'phoneMobile',
                    'englishLevel',
                    'height',
                    'size',
                    'weight',
                    'education',
                    'study',
                    'earliestDate',
                    'latestDate',
                    'swimming',
                    'drivingExperience',
                    'studyingEn',
                    'otherLanguage',
                    'beforeUS',
                    'workExperience',
                    'skills'
                )
            );
        });
    }
}

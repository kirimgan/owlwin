<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOffersEmployersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->mediumText('company_info');
            DB::statement('ALTER TABLE `users` CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL;');
        });

        Schema::table('users', function (Blueprint $table) {
            DB::statement('ALTER TABLE `applicationcv_form_entries` CHANGE `dateOfBirth` `dateOfBirth` DATE  NULL;');
            DB::statement('ALTER TABLE `applicationcv_form_entries` CHANGE `earliestDate` `earliestDate` DATE  NULL;');
            DB::statement('ALTER TABLE `applicationcv_form_entries` CHANGE `latestDate` `latestDate` DATE  NULL;');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['company_info']);
            DB::statement('ALTER TABLE `users` CHANGE `email` `email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;');
        });
    }
}

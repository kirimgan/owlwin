<?php

use Illuminate\Database\Seeder;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->truncate();

        DB::table('states')->insert(
            array(
                array('name' =>'Alabama'),
                array('name' =>'Alaska'),
                array('name' =>'Arizona'),
                array('name' =>'Arkansas'),
                array('name' =>'California'),
                array('name' =>'Colorado'),
                array('name' =>'Connecticut'),
                array('name' =>'Delaware'),
                array('name' =>'District of Columbia'),
                array('name' =>'Florida'),
                array('name' =>'Georgia'),
                array('name' =>'Hawaii'),
                array('name' =>'Idaho'),
                array('name' =>'Illinois'),
                array('name' =>'Indiana'),
                array('name' =>'Iowa'),
                array('name' =>'Kansas'),
                array('name' =>'Kentucky'),
                array('name' =>'Louisiana'),
                array('name' =>'Maine'),
                array('name' =>'Maryland'),
                array('name' =>'Massachusetts'),
                array('name' =>'Michigan'),
                array('name' =>'Minnesota'),
                array('name' =>'Mississippi'),
                array('name' =>'Missouri'),
                array('name' =>'Montana'),
                array('name' =>'Nebraska'),
                array('name' =>'Nevada'),
                array('name' =>'New Hampshire'),
                array('name' =>'New Jersey'),
                array('name' =>'New Mexico'),
                array('name' =>'New York'),
                array('name' =>'North Carolina'),
                array('name' =>'North Dakota'),
                array('name' =>'Ohio'),
                array('name' =>'Oklahoma'),
                array('name' =>'Oregon'),
                array('name' =>'Pennsylvania'),
                array('name' =>'Rhode Island'),
                array('name' =>'South Carolina'),
                array('name' =>'South Dakota'),
                array('name' =>'Tennessee'),
                array('name' =>'Texas'),
                array('name' =>'Utah'),
                array('name' =>'Vermont'),
                array('name' =>'Virginia'),
                array('name' =>'Washington'),
                array('name' =>'West Virginia'),
                array('name' =>'Wisconsin'),
                array('name' =>'Wyoming')
            )
        );
    }
}

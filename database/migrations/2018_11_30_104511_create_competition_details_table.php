<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competition_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('eGroup');
            $table->string('location');
            $table->date('rebate_date');
            $table->date('last_date_to_register');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competition_details');
    }
}

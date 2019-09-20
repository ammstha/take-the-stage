<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformerPerformerEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performer_performer_entry', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('performer_id')->unsigned();
            $table->foreign('performer_id')->references('id')->on('performers');

            $table->integer('performer_entry_id')->unsigned();
            $table->foreign('performer_entry_id')->references('id')->on('performer_entries');
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
        Schema::dropIfExists('performer_performer_entry');
    }
}

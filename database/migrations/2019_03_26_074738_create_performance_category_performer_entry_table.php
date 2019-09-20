<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceCategoryPerformerEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_category_performer_entry', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('performer_entry_id')->unsigned();
            $table->foreign('performer_entry_id')->references('id')->on('performer_entries');

//            name should be two long
            $table->integer('P_category_id')->unsigned();
            $table->foreign('P_category_id')->references('id')->on('performance_categories');

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
        Schema::dropIfExists('performance_category_performer_entry');
    }
}

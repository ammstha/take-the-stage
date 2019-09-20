<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformerEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

//       'performer','category',
        Schema::create('performer_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('division');
            $table->string('average_age');
            $table->string('age_class');
            $table->string('performance_level');
            $table->integer('user_id');
            $table->integer('competitionDetail_id');
            $table->boolean('exceed')->default(0);
            $table->boolean('donate')->default(0);
            $table->boolean('prop')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('orderBy')->default(0);
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
        Schema::dropIfExists('performer_entries');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('answer_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('lesson_id')->nullable();
            $table->integer('gain_id')->nullable();
            $table->string('selectedoption')->nullable();
            $table->string('trueoption')->nullable();
            $table->string('examquestion_id')->nullable();
            $table->string('truetype')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('answer_items');
    }
}

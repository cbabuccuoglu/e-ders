<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trialexam_id')->nullable();
            $table->integer('lesson_id')->nullable();
            $table->integer('gains_id')->nullable();
            $table->string('point')->nullable();
            $table->string('image')->nullable();
            $table->string('questionstype')->nullable();
            $table->integer('order')->nullable();
            $table->string('trueresult')->nullable();
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
        Schema::dropIfExists('exam_questions');
    }
}

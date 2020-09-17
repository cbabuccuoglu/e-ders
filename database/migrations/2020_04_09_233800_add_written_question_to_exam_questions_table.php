<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWrittenQuestionToExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            $table->string('Wquestion')->nullable();
            $table->string('WoptionA')->nullable();
            $table->string('WoptionB')->nullable();
            $table->string('WoptionC')->nullable();
            $table->string('WoptionD')->nullable();
            $table->string('WoptionE')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_questions', function (Blueprint $table) {
            //
        });
    }
}

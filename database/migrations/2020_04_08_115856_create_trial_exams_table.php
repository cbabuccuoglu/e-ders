<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrialExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trial_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('classNumber')->nullable();
            $table->string('startpoint')->nullable();
            $table->string('start_date')->nullable();
            $table->string('finish_date')->nullable();
            $table->string('resulttype')->nullable();
            $table->string('type')->nullable();
            $table->string('dyType')->nullable();
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
        Schema::dropIfExists('trial_exams');
    }
}

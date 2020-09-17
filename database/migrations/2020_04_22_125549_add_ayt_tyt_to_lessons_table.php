<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAytTytToLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('lesson_type')->nullable();
            $table->string('sayisal')->nullable();
            $table->string('esitagirlik')->nullable();
            $table->string('sozel')->nullable();
            $table->string('yabancidil')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('lesson_type')->nullable();
            $table->string('sayisal')->nullable();
            $table->string('esitagirlik')->nullable();
            $table->string('sozel')->nullable();
            $table->string('yabancidil')->nullable();
        });
    }
}

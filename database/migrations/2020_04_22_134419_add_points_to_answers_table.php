<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPointsToAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->string('tytpuan')->nullable();
            $table->string('aytsayisal')->nullable();
            $table->string('aytesit')->nullable();
            $table->string('aytsozel')->nullable();
            $table->string('ydspuan')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->string('tytpuan')->nullable();
            $table->string('aytsayisal')->nullable();
            $table->string('aytesit')->nullable();
            $table->string('aytsozel')->nullable();
            $table->string('ydspuan')->nullable();
        });
    }
}

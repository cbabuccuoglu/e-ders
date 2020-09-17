<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('units')->nullable();
            $table->string('name')->nullable();
            $table->string('classNumber')->nullable();
            $table->string('lesson_id')->nullable();
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
        Schema::dropIfExists('gains');
    }
}

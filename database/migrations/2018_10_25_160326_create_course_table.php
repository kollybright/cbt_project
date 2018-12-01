<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->string('course_code');
            $table->string('course_title');
            $table->integer('lecturer_id')->unsigned();
            $table->foreign('lecturer_id')->references('id')->on('lecturer');
            $table->enum('semester',['rain','harmattan']);
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
        Schema::dropIfExists('course');
    }
}

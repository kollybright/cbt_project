<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::defaultStringLength(191);
            Schema::create('lecturer', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('first_name');
                $table->string('last_name');
                $table->rememberToken();
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
        Schema::dropIfExists('lecturer');
    }
}

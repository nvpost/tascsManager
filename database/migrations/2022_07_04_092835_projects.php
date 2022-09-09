<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('label');
            $table->longText('description');
            $table->dateTime('start_date');
            $table->dateTime('finish_date')->nullable();
            $table->string('status')->default('1');
            $table->timestamps();
        });

//        Schema::table('projects', function (Blueprint $table) {
//            $table->dateTime('finish_date')->default(NULL);
//        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

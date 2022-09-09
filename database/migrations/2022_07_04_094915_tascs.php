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
//        Schema::create('tascs', function (Blueprint $table) {
//            $table->id();
//            $table->string('user_id');
//            $table->string('project_id');
//            $table->string('label');
//            $table->longText('description');
//            $table->timestamps();
//            $table->dateTime('start_date');
//            $table->dateTime('finish_date');
//            $table->string('status');
//        });

        Schema::table('tascs', function (Blueprint $table) {
            $table->string('status')->default('1');

        });
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

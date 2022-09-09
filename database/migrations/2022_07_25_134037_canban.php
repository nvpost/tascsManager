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
        Schema::create('canbans', function(Blueprint $table){
            $table->id();
            $table->integer('project_id');
            $table->integer('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('boards', function(Blueprint $table){
            $table->id();
            $table->integer('canban_id');
            $table->integer('user_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('position');
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
        //
    }
};

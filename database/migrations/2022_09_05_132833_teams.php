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
        Schema::create('teams', function(Blueprint $table){
            $table->id();
            $table->integer('creator_id');
            $table->string('name');
            $table->text('description')->default(' ');
            $table->integer('status')->default(1);;
            $table->timestamps();
        });

        Schema::create('teams_statuses', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('team_users_meta', function(Blueprint $table){
            $table->id();
            $table->integer('team_id');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('team_project_meta', function(Blueprint $table){
            $table->id();
            $table->integer('team_id');
            $table->integer('project_id');
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

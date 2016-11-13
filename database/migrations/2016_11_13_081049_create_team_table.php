<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_members',function(Blueprint $table){
            $table->increments('id');
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('designation',255);
            $table->text('description');
            $table->string('image',255);
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('team_members');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects',function(Blueprint $table){
            $table->increments('id');
            $table->string('title',210);
            $table->string('slug');
            $table->text('description');
            $table->string('state');
            $table->string('company');
            $table->string('image')->nullable();
            $table->string('project_type')->nullable();
            $table->string('length')->nullable();
            $table->dateTime('completion_date')->nullable();
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
        Schema::drop('projects');
    }
}

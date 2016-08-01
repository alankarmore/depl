<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services',function(Blueprint $table){
           $table->increments('id'); 
           $table->string('title',200); 
           $table->string('slug',255); 
           $table->text('description'); 
           $table->string('image',255); 
           $table->tinyInteger('status');
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
        Schema::drop('services');
    }
}

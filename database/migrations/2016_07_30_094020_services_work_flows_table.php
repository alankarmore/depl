<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServicesWorkFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_flows',function(Blueprint $table){
           $table->increments('id'); 
           $table->integer('services_id'); 
           $table->string('title',200); 
           $table->string('slug',255); 
           $table->text('description');
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
        Schema::drop('work_flows');
    }
}

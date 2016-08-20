<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OurOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('offices',function(Blueprint $table){
            $table->increments('id')->autoincrement();
            $table->string('title');
            $table->tinyInteger('type');
            $table->string('state',255);
            $table->string('city',255);
            $table->text('address'); 
            $table->string('pincode',50); 
            $table->string('phone',20); 
            $table->string('fax',20); 
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
        Schema::drop('offices');
    }
}

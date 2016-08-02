<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_menu',function(BluePrint $table) {
            $table->increments('id');
            $table->integer('include_in')->nullable();
            $table->string('title',150);
            $table->string('slug');
            $table->string('image');
            $table->text('description');
            $table->string('meta_title',255);
            $table->string('meta_keyword',255);
            $table->string('meta_description',255);
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
        //
    }
}

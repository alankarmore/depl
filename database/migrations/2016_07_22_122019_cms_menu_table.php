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
            $table->string('title',150);
            $table->string('slug');
            $table->string('image');
            $table->text('description');
            $table->smallInteger('status');
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

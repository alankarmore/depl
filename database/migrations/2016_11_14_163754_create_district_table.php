<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts',function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',150);
            $table->string('slug');
            $table->string('lat',20);
            $table->string('lng',20);
            $table->integer('states_id');
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
        Schema::create('districts');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("networks",function(Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->string('title');
            $table->string('city');
            $table->string('address');
            $table->string('pincode',20);
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::drop("networks");
    }
}

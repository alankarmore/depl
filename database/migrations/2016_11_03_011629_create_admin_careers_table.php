<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminCareersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_openings',function(Blueprint $table) {
            $table->increments('id');
            $table->string('title',200);
            $table->string('slug',255);
            $table->text('description');
            $table->string('location');
            $table->string('experience');
            $table->string('qualification');
            $table->string('skills')->nullable();;
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->string('meta_description');
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
        Schema::drop('current_openings');
    }
}

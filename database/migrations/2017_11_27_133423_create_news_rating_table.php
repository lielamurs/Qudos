<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rating');
            $table->integer('admin_id')->unsigned();
            $table->integer('news_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->foreign('news_id')->references('id')->on('news');
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
        Schema::dropIfExists('news_rating');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rating');
            $table->integer('user_id')->unsigned();
            $table->integer('feedback_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('feedback_id')->references('id')->on('feedback');
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
        Schema::dropIfExists('feedback_rating');
    }
}

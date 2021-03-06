<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggestion_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rating');
            $table->integer('user_id')->unsigned();
            $table->integer('suggestion_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('suggestion_id')->references('id')->on('suggestions');
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
        Schema::dropIfExists('suggestion_rating');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('client_id');
          $table->unsignedBigInteger('workout_id');
          $table->string('note', 150);
          $table->float('rating');
          $table->timestamps();
          $table->softDeletes();
          $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('workout_id')->references('id')->on('workouts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}

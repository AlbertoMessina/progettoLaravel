<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('master_id');
           $table->unsignedBigInteger('class_id');
           $table->string('name', 100);
           $table->string('description', 350);
           $table->date('publication_date');
           $table->float('rating');
           $table->timestamps();
           $table->softDeletes();
           $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('master_id')->references('id')->on('masters')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workouts');
    }
}

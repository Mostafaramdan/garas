<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_table', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('periodType',['am','pm']);

            $table->unsignedBigInteger('subjects_id')->nullable();
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->unsignedBigInteger('grades_id');
            $table->foreign('grades_id')->references('id')->on('grades')->onDelete('cascade');

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
        Schema::dropIfExists('exams');
    }
};

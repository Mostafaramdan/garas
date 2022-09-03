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
        Schema::create('daily_supervisions', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('teachers_id');
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('schools_id');
            $table->foreign('schools_id')->references('id')->on('schools')->onDelete('cascade');

            $table->text('notes');
            $table->enum('day',['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday']);
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
        Schema::dropIfExists('daily_supervisions');
    }
};

<?php
namespace database\migrations;

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
        Schema::create('grade_subject', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grades_id')->nullable();
            $table->foreign('grades_id')->references('id')->on('grades')->onDelete('cascade');

            $table->unsignedBigInteger('subjects_id')->nullable();
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');
           
            $table->integer('matrimonial_portions')->default(0);
            $table->integer('individual_portions')->default(0);
            $table->unique(['subjects_id','grades_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_subject');
    }
};

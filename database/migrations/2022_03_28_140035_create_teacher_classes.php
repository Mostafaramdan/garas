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
        Schema::create('teacher_classes', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('teachers_id')->nullable();
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('classes_id')->nullable();
            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('cascade');

            $table->unsignedBigInteger('subjects_id')->nullable();
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');

            $table->unique(['teachers_id','classes_id','subjects_id']);

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
        Schema::dropIfExists('teacher_classes');
    }
};

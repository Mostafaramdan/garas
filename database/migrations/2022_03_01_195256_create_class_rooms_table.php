<?php
namespace database\migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms_tables', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_timetables_id');
            $table->foreign('school_timetables_id')->references('id')->on('school_timetables')->onDelete('cascade');

            $table->unsignedBigInteger('teachers_id')->nullable();
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('waiting_teachers_id')->nullable();
            $table->foreign('waiting_teachers_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('subjects_id')->nullable();;
            $table->foreign('subjects_id')->references('id')->on('subjects')->onDelete('cascade');
            
            $table->unsignedBigInteger('class_rooms_in_days_id');
            $table->foreign('class_rooms_in_days_id')->references('id')->on('class_rooms_in_days')->onDelete('cascade');


            $table->unsignedBigInteger('classes_id')->nullable();
            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('cascade');
            $table->unique(['class_rooms_in_days_id','classes_id','school_timetables_id']);

            
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
        Schema::dropIfExists('class_rooms_tables');
    }
};

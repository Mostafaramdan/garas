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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->enum('type',['teacherToClass','schoolToClass','schoolToTeacher','adminToteachers','adminToAll'])->nullable();
            
            $table->unsignedBigInteger('schools_id')->nullable();
            $table->foreign('schools_id')->references('id')->on('schools')->onDelete('cascade');

            $table->unsignedBigInteger('teachers_id')->nullable();
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('admins_id')->nullable();
            $table->foreign('admins_id')->references('id')->on('admins')->onDelete('cascade');

            $table->unsignedBigInteger('classes_id')->nullable();
            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('cascade');

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
        Schema::dropIfExists('notifications');
    }
};

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
        Schema::create('notify', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_id')->nullable();
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedBigInteger('teachers_id')->nullable();
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->unsignedBigInteger('schools_id')->nullable();
            $table->foreign('schools_id')->references('id')->on('schools')->onDelete('cascade');

            $table->unsignedBigInteger('notifications_id')->nullable();
            $table->foreign('notifications_id')->references('id')->on('notifications')->onDelete('cascade');

            $table->boolean('is_seen')->default(0);

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
        Schema::dropIfExists('notify');
    }
};

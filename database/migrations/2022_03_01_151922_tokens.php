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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('students_id')->nullable();
            $table->foreign('students_id')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedBigInteger('teachers_id')->nullable();
            $table->foreign('teachers_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->string('apiToken');
            $table->string('deviceId');
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
        Schema::dropIfExists('tokens');
    }
};

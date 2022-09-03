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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('firebaseToken')->nullable();
            $table->string('name')->nullable();

            $table->unsignedBigInteger('classes_id')->nullable();
            $table->foreign('classes_id')->references('id')->on('classes')->onDelete('cascade');

            $table->enum('lang',['ar','en'])->nullable();
            $table->boolean('switch_notification')->default(1);

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
        Schema::dropIfExists('students');
    }
};

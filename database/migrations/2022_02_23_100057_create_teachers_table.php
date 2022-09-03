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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('firebaseToken')->nullable();
            $table->enum('lang',['ar','en'])->nullable();

            $table->string('phone')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('switch_notification')->default(1);
            
            $table->unsignedBigInteger('schools_id')->nullable();
            $table->foreign('schools_id')->references('id')->on('schools')->onDelete('cascade');

            $table->integer('code')->unique();
            $table->integer('max_class_rooms')->default(24);
            $table->integer('max_waiting_class_rooms');
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
        Schema::dropIfExists('teachers');
    }
};

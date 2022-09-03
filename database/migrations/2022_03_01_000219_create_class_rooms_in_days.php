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
        Schema::create('class_rooms_in_days', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->unsignedBigInteger('class_rooms_id')->nullable();
            $table->foreign('class_rooms_id')->references('id')->on('class_rooms')->onDelete('cascade');

            $table->unique(['day','class_rooms_id']);
            $table->boolean('is_active')->default(1);


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
        Schema::dropIfExists('class_rooms_in_days');
    }
};

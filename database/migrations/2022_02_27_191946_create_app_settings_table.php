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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schools_id')->nullable();
            $table->foreign('schools_id')->references('id')->on('schools')->onDelete('cascade');

            $table->integer('Classrooms_Count')->nullable();
            $table->time('time_of_classroom')->nullable();
            $table->string('day_off1')->nullable();
            $table->string('day_off2')->nullable();
            $table->dateTime('start_day')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->text('about_ar')->nullable();
            $table->text('about_en')->nullable();
            $table->text('terms_ar')->nullable();
            $table->text('terms_en')->nullable();
            $table->text('title_last_update')->nullable();
            $table->text('url_last_update')->nullable();




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
        Schema::dropIfExists('app_settings');
    }
};

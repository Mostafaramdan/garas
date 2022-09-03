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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('user_name');
            $table->string('manager')->nullable();
            $table->string('education_administration')->nullable();
            $table->enum('lang',['ar','en'])->nullable();
            $table->string('phone2')->nullable();
            $table->string('password')->nullable();
            $table->boolean('is_active')->default(1);
            $table->unsignedInteger('city_id')->nullable();
            $table->string('country')->default('Saudi Arabia');
            $table->string('state')->nullable();

            $table->integer('Classrooms_Count')->nullable()->default(0);
            $table->integer('ClassroomTableCount')->nullable()->default(0);
            $table->integer ('time_of_classroom')->nullable()->default('0');
            $table->string('day_off1')->nullable();
            $table->string('day_off2')->nullable();
            $table->time('start_day')->nullable()->default('08:00');


            $table->unsignedBigInteger('roles_id')->nullable();
            $table->foreign('roles_id')->references('id')->on('roles')->nullOnDelete();

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
        Schema::dropIfExists('schools');
    }
};

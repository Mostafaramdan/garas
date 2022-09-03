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


        Schema::disableForeignKeyConstraints();
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('packages_id');
            $table->foreign('packages_id')->references('id')->on('packeges')->onDelete('cascade');

            $table->unsignedBigInteger('schools_id');
            $table->foreign('schools_id')->references('id')->on('schools')->onDelete('cascade');

            $table->double('price');
            
            $table->dateTime('subscribed_at');
            $table->dateTime('end_at');
            
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
        Schema::dropIfExists('subscriptions');
    }
};

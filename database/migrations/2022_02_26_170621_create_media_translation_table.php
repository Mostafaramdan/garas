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
        Schema::create('media_translation', function (Blueprint $table) {
            $table->id();

            $table->integer('media_id')->unsigned();
            $table->string('locale')->index();

            $table->text('title')->nullable();
            $table->longText('description')->nullable();

            $table->unique(['media_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_translation');
    }
};

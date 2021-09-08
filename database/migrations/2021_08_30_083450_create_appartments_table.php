<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->string('title', 150);
            $table->string('slug', 150)->unique();
            $table->text('description');
            $table->unsignedTinyInteger('rooms_number');
            $table->unsignedTinyInteger('bathrooms_number');
            $table->unsignedTinyInteger('beds_number');
            $table->unsignedMediumInteger('square_meters');
            $table->string('image');
            $table->boolean('visible')->default(true);
            $table->decimal('longitude', 11,8);
            $table->decimal('latitude', 11,8);
            $table->string('address');
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
        Schema::dropIfExists('appartments');
    }
}

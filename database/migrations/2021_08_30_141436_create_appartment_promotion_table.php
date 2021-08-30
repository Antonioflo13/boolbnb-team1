<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppartmentPromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appartment_promotion', function (Blueprint $table) {
            $table->unsignedBigInteger('appartment_id');
            $table->foreign('appartment_id')->references('id')->on('appartments')->onDelete('CASCADE');

            $table->unsignedBigInteger('promotion_id');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('CASCADE');

            $table->primary(['appartment_id', 'promotion_id']);
            $table->dateTime('start_promotion');
            $table->dateTime('end_promotion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appartment_promotion');
    }
}

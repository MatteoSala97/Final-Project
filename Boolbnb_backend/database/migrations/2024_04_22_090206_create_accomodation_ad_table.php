<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accomodation_ad', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('accomodation_id');
            $table->foreign('accomodation_id')->references('id')->on('accomodations');

            $table->unsignedBigInteger('ad_id');
            $table->foreign('ad_id')->references('id')->on('ads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomodation_ad');
    }
};

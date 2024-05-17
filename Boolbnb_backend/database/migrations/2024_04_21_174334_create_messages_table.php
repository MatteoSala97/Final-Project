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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->string('email', 255)->nullable();
            $table->string('recipient_email', 255)->nullable();
            $table->foreignId('accomodation_id')->constrained('accomodations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['accomodation_id']);
        });
        Schema::dropIfExists('messages');
    }
};

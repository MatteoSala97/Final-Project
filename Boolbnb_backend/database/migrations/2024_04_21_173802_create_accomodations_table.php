<?php

use App\Models\Ad;
use App\Models\User;
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
        Schema::create('accomodations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->max(255);
            $table->string('type')->nullable()->max(255);
            $table->tinyInteger('rooms');
            $table->tinyInteger('beds')->default(1);
            $table->tinyInteger('bathrooms')->nullable();
            $table->string('address')->max(255);
            $table->string('city')->max(100);
            $table->decimal('latitude', 10, 6);
            $table->decimal('longitude', 10, 6);
            $table->decimal('price_per_night', 10, 2);
            $table->boolean('hidden')->default(false);
            $table->string('thumb')->max(255)->nullable();
            $table->string('host_thumb')->max(255)->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accomodations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('accomodations');
    }
};

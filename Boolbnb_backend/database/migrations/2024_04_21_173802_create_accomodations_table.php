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
            $table->string('title')->nullable(false)->max(255);
            $table->string('type')->nullable(true)->max(255);
            $table->tinyInteger('rooms')->nullable(false);
            $table->tinyInteger('beds')->nullable(false)->default(1);
            $table->tinyInteger('bathrooms')->nullable(true);
            $table->decimal('square_m', total: 10, places: 2)->nullable(true);
            $table->string('address')->nullable(false)->max(255);
            $table->decimal('latitude', total: 10, places: 6)->nullable(false);
            $table->decimal('longitude', total: 10, places: 6)->nullable(false);
            $table->decimal('price_per_night', total: 10, places: 2)->nullable(false);
            $table->boolean('hidden')->default(false);
            $table->string('thumb')->max(255)->nullable(true);
            $table->string('host_thumb')->max(255)->nullable(true);
            $table->decimal('price_per_night', total: 10, places: 2)->nullable(false);
            $table->decimal('rating', total: 3, places: 2)->nullable(true);
            $table->foreignId(User::class)->nullable(true)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomodations');
    }
};

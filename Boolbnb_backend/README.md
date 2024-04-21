<!-- php artisan make:migration create_accommodation_service_table -->


<!-- MATTE -->

<!-- <?php

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
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->max(255);
            $table->string('url')->max(1024);
            $table->foreign('accomodation_id')->references('id')->on('accomodations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropForeign(['accommodation_id']);
        });

        Schema::dropIfExists('pictures');
    }
}; -->

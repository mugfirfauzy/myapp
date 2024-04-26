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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->foreignId('province_id')->constrained('ro_provinces')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('ro_cities')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('ro_districts')->onDelete('cascade');
            $table->string('postal_code');
            $table->foreignId('user_id')-> constrained('users')->onDelete('cascade');
            $table->boolean('is_default')->default(false) ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};

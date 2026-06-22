<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();         // path to uploaded image
            $table->string('location')->nullable();      // city/country
            $table->decimal('price_per_night', 10, 2);  // price in USD
            $table->string('category')->default('hotel'); // hotel / traveling
            // Facilities (boolean flags)
            $table->boolean('has_ac')->default(false);
            $table->boolean('has_wifi')->default(false);
            $table->boolean('has_restaurant')->default(false);
            $table->boolean('has_front_desk')->default(false);
            $table->boolean('has_parking')->default(false);
            $table->boolean('has_pool')->default(false);
            $table->boolean('has_gym')->default(false);
            $table->boolean('has_laundry')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};

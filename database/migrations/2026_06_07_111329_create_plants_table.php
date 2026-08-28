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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();

            // Required fields
            $table->string('plant_name');
            $table->string('scientific_name');
            $table->string('category');
            $table->string('image');

            // Optional fields
            $table->text('suitability')->nullable();
            $table->text('growth_period')->nullable();
            $table->text('growing_season')->nullable();
            $table->text('sunlight_requirement')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};

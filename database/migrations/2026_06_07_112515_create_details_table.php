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
        Schema::create('details', function (Blueprint $table) {
             $table->id();

            // Original values
            $table->text('annual_rainfall')->nullable();
            $table->string('humidity')->nullable();
            $table->string('monsoon_tolerance')->nullable();
            $table->string('soil_moisture')->nullable();
            $table->string('drainage')->nullable();
            $table->string('drought_tolerance')->nullable();
            $table->string('light')->nullable();
            $table->string('soil_type')->nullable();

            $table->text('fertilizing_schedule')->nullable();
            $table->text('repotting_frequency')->nullable();
            $table->text('support_needed')->nullable();
            $table->text('common_mistakes')->nullable();

            $table->string('preferred_soil_type')->nullable();
            $table->string('soil_ph_range')->nullable();
            $table->string('texture_requirement')->nullable();
            $table->text('organic_matter_need')->nullable();
            $table->text('ground_soil_preparation')->nullable();
            $table->text('nutrient_preference')->nullable();

            $table->text('watering_frequency')->nullable();
            $table->text('water_amount')->nullable();
            $table->text('season_watering')->nullable();
            $table->text('soil_check_method')->nullable();

            $table->text('common_pests')->nullable();
            $table->text('signs_of_infestation')->nullable();
            $table->text('organic_control_methods')->nullable();
            $table->text('chemical_control')->nullable();
            $table->text('spray_intervals')->nullable();
            $table->text('preventive_measures')->nullable();
            $table->text('soil_borne_disease_signs')->nullable();

            $table->text('ideal_temperature')->nullable();
            $table->text('min_temperature')->nullable();
            $table->text('max_temperature')->nullable();

            $table->string('season_preference')->nullable();
            $table->text('indoor_outdoor_suitability')->nullable();
            $table->text('frost_tolerance')->nullable();
            $table->text('heat_tolerance')->nullable();

            $table->string('lifecycle')->nullable();
            $table->string('growth_rate')->nullable();
            $table->string('mature_size')->nullable();
            $table->text('flowering_fruiting_season')->nullable();
            $table->string('growing_season')->nullable();
            $table->text('ideal_environment')->nullable();

            /*
             |--------------------------------------------------------------------------
             | Numeric values extracted from text
             |--------------------------------------------------------------------------
             */

            $table->unsignedInteger('annual_rainfall_min_mm')->nullable();
            $table->unsignedInteger('annual_rainfall_max_mm')->nullable();

            $table->decimal('ideal_temp_min_c', 8, 2)->nullable();
            $table->decimal('ideal_temp_max_c', 8, 2)->nullable();

            $table->decimal('min_temp_c', 8, 2)->nullable();

            $table->decimal('max_temp_c', 8, 2)->nullable();

            // One-to-One Relationship
            $table->foreignId('plant_id')
                  ->unique()
                  ->constrained('plants')
                  ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};

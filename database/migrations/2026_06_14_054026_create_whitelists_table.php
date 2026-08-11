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
        Schema::create('whitelists', function (Blueprint $table) {
            $table->id();
            
            // 1-1 Relationship with the User table
            // unique() enforces the 1-1 constraint at the database level
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('plant_name');
            $table->string('scientific_name')->nullable(); // Made nullable in case it's missing
            $table->string('image')->nullable();           // Path/URL to the image
            $table->string('category')->nullable();
            
            // Assuming plant_id refers to an external API ID or another table
            $table->string('plant_id'); 

            // public $timestamps = false; is set in your model, 
            // so $table->timestamps() is omitted here.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whitelists');
    }
};
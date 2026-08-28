<?php

namespace Database\Seeders;

use App\Models\Detail;
use App\Models\Plant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Parse and insert Plants
        $plantsJson = File::get(resource_path('js/plants.json'));
        $plants = json_decode($plantsJson, true);

        foreach ($plants as $plant) {
            Plant::create($plant);
        }

        // 2. Parse and insert Details
        $detailsJson = File::get(resource_path('js/plant_detail.json'));
        $details = json_decode($detailsJson, true);

        foreach ($details as $detail) {
            Detail::create($detail);
        }
    }
}

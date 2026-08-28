<?php

namespace App\Services;

class PlantDataParser
{
    /**
     * Extract Rainfall in mm.
     * Matches patterns like: "600-1200 mm", "(635-1270 mm)", "900-2500 mm"
     */
    public static function extractRainfallMm(?string $value): array
    {
        if (!$value) {
            return ['min' => null, 'max' => null];
        }

        // Clean up any weird spacing/newlines to make matching cleaner
        $value = preg_replace('/\s+/', ' ', $value);

        // Matches any "X-Y mm" sequence, ignoring whether it has parentheses or text around it
        if (preg_match('/(\d+)\s*-\s*(\d+)\s*mm/i', $value, $matches)) {
            return [
                'min' => (int) $matches[1],
                'max' => (int) $matches[2],
            ];
        }

        // Fallback: If text says "Moderate to high", provide standard agricultural thresholds
        $lowerValue = strtolower($value);
        if (str_contains($lowerValue, 'moderate') || str_contains($lowerValue, 'high')) {
            return ['min' => 500, 'max' => 1200];
        }

        return ['min' => null, 'max' => null];
    }

    /**
     * Extract Celsius range.
     * Matches patterns like: "18-25°C", "(18-29°C)", "24-30°C"
     */
    public static function extractCelsiusRange(?string $value): array
    {
        if (!$value) {
            return ['min' => null, 'max' => null];
        }

        // Clean up spacing and newlines
        $value = preg_replace('/\s+/', ' ', $value);

        // Matches "X-Y°C" or "X-Y C" anywhere in the string, handles decimals and negative numbers.
        // Added 'u' modifier at the end to safely handle the UTF-8 degree (°). symbol
        if (preg_match('/(-?\d+(?:\.\d+)?)\s*-\s*(-?\d+(?:\.\d+)?)\s*°?C/ui', $value, $matches)) {
            return [
                'min' => isset($matches[1]) ? (float) $matches[1] : null,
                'max' => isset($matches[2]) ? (float) $matches[2] : null,
            ];
        }

        return ['min' => null, 'max' => null];
    }

    /**
     * Extract single Celsius value safely out of descriptive blocks.
     * Matches text like: above 90°F (32°C), especially with low humidity...
     */
    public static function extractSingleCelsius(?string $value): ?float
    {
        if (!$value) {
            return null;
        }

        // Refined RegEx pattern to extract the digits inside (°C) anywhere in the text
        if (preg_match('/\(?(-?\d+(?:\.\d+)?)\s*°C\)?/i', $value, $matches)) {
            return (float) $matches[1];
        }

        return null;
    }
}

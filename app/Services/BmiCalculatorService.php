<?php

namespace App\Services;

/**
 * BMI Calculator Service
 *
 * This service handles all BMI calculation logic following OOP principles.
 * Single Responsibility: Only handles BMI calculations
 */
class BmiCalculatorService
{
    /**
     * Calculate BMI from height and weight
     * Formula: BMI = weight(kg) / height(m)²
     *
     * @param float $height Height in centimeters
     * @param float $weight Weight in kilograms
     * @return float BMI value rounded to 2 decimal places
     */
    public function calculateBmi(float $height, float $weight): float
    {
        $heightInMeters = $height / 100;
        $bmi = $weight / ($heightInMeters * $heightInMeters);

        return round($bmi, 2);
    }

    /**
     * Determine BMI category based on BMI value
     *
     * Categories:
     * - < 18.5: Kekurangan Berat Badan (Underweight)
     * - 18.5 - 24.9: Normal
     * - 25 - 29.9: Kelebihan Berat Badan (Overweight)
     * - >= 30: Obesitas (Obese)
     *
     * @param float $bmi BMI value
     * @return string Category name
     */
    public function getBmiCategory(float $bmi): string
    {
        if ($bmi < 18.5) {
            return 'Kekurangan Berat Badan';
        } elseif ($bmi < 25) {
            return 'Normal';
        } elseif ($bmi < 30) {
            return 'Kelebihan Berat Badan';
        } else {
            return 'Obesitas';
        }
    }

    /**
     * Calculate ideal weight using Broca formula with gender adjustment
     *
     * Formula:
     * - Male: (height - 100) - ((height - 100) × 0.10)
     * - Female: (height - 100) - ((height - 100) × 0.15)
     *
     * @param float $height Height in centimeters
     * @param string $gender Gender ('male' or 'female')
     * @return float Ideal weight in kilograms
     */
    public function calculateIdealWeight(float $height, string $gender): float
    {
        $base = $height - 100;

        $multiplier = $gender === 'male' ? 0.10 : 0.15;
        $idealWeight = $base - ($base * $multiplier);

        return round($idealWeight, 2);
    }

    /**
     * Calculate minimum healthy weight (BMI 18.5)
     *
     * @param float $height Height in centimeters
     * @return float Minimum weight in kilograms
     */
    public function calculateMinWeight(float $height): float
    {
        $heightInMeters = $height / 100;
        $minWeight = 18.5 * ($heightInMeters * $heightInMeters);

        return round($minWeight, 2);
    }

    /**
     * Calculate maximum healthy weight (BMI 24.9)
     *
     * @param float $height Height in centimeters
     * @return float Maximum weight in kilograms
     */
    public function calculateMaxWeight(float $height): float
    {
        $heightInMeters = $height / 100;
        $maxWeight = 24.9 * ($heightInMeters * $heightInMeters);

        return round($maxWeight, 2);
    }

    /**
     * Calculate all BMI-related values at once
     *
     * @param float $height Height in centimeters
     * @param float $weight Weight in kilograms
     * @param string $gender Gender ('male' or 'female')
     * @return array Array containing all calculated values
     */
    public function calculateAll(float $height, float $weight, string $gender): array
    {
        $bmi = $this->calculateBmi($height, $weight);

        return [
            'bmi' => $bmi,
            'category' => $this->getBmiCategory($bmi),
            'ideal_weight' => $this->calculateIdealWeight($height, $gender),
            'min_weight' => $this->calculateMinWeight($height),
            'max_weight' => $this->calculateMaxWeight($height),
        ];
    }
}

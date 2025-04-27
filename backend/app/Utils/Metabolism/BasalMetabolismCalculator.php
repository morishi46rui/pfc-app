<?php

declare(strict_types=1);

namespace App\Utils\Metabolism;

class BasalMetabolismCalculator
{
    private const MALE_BASE = 88.362;

    private const MALE_WEIGHT_FACTOR = 13.397;

    private const MALE_HEIGHT_FACTOR = 4.799;

    private const MALE_AGE_FACTOR = 5.677;

    private const FEMALE_BASE = 447.593;

    private const FEMALE_WEIGHT_FACTOR = 9.247;

    private const FEMALE_HEIGHT_FACTOR = 3.098;

    private const FEMALE_AGE_FACTOR = 4.330;

    public static function calculate(string $gender, float $weight, float $height, int $age): float
    {
        return match ($gender) {
            'male' => self::MALE_BASE
                + self::MALE_WEIGHT_FACTOR * $weight
                + self::MALE_HEIGHT_FACTOR * $height
                - self::MALE_AGE_FACTOR * $age,
            'female' => self::FEMALE_BASE
                + self::FEMALE_WEIGHT_FACTOR * $weight
                + self::FEMALE_HEIGHT_FACTOR * $height
                - self::FEMALE_AGE_FACTOR * $age,
        };
    }
}

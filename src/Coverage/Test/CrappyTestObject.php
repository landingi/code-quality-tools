<?php

namespace Landingi\QualityTools\Coverage\Test;

/**
 * This class is used in testing CrapIndexValidator by executing coverage on it and checks if crap index resolver is working correctly
 */
class CrappyTestObject
{
    private int $first;
    private int $second;
    private int $third;
    private string $fourth;
    private array $complexArray;

    public function __construct(int $first, int $second, int $third, string $fourth, array $complexArray)
    {
        $this->first = $first;
        $this->second = $second;
        $this->third = $third;
        $this->fourth = $fourth;
        $this->complexArray = $complexArray;
    }

    public function executeCrappyCode(): array
    {
        $crappyArg1 = $this->first;
        $crappyArg2 = $this->second;
        $crappyArg3 = $this->third;
        $crappyArg4 = $this->fourth;

        foreach ($this->complexArray as $crappyKey => $crappyValue) {
            if ($crappyKey % 2) {
                foreach ($crappyValue as $nestedCrappyValue) {
                    foreach ($nestedCrappyValue as $itsEnough) {
                        if (!$itsEnough &= 2) {
                            return [
                                $itsEnough => [
                                    $crappyArg1,
                                    $crappyArg2,
                                    $crappyArg3,
                                    $crappyArg4,
                                ]
                            ];
                        }
                    }
                }
            }
        }

        return [
            null => [
                $crappyArg1,
                $crappyArg2,
                $crappyArg3,
                $crappyArg4,
            ]
        ];
    }
}

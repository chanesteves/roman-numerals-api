<?php

namespace App\Services;

class RomanNumeralConverter implements IntegerConverterInterface
{
    public function convertInteger(int $integer): string {
        $result = '';
        $conversion_mapping = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];

        while ($integer > 0) {
            foreach ($conversion_mapping as $roman => $number) {
                if ($integer >= $number) {
                    $integer -= $number;
                    $result .= $roman;
                    break;
                }
            }
        }

        return $result;
    }
}

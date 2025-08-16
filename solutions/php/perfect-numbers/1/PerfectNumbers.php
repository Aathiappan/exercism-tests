<?php
declare(strict_types=1);

function getClassification(int $number): string
{
    if($number < 1){
        throw new InvalidArgumentException("Natural number only");
    }
    $sum_of_divisor = 0;
    $i = 1;
    while($i < $number){
        if(($number % $i) === 0){
            $sum_of_divisor += $i;
        }
        $i++;
    }
    return match(true){
        $sum_of_divisor > $number => 'abundant',
        $sum_of_divisor === $number => 'perfect',
        $sum_of_divisor < $number => 'deficient',
    };
}

<?php

declare(strict_types=1);

function sumOfMultiples(int $number, array $multiples): int
{
    if(!($number > 0)){
        return 0;
    }
    $baseMultiples = [];
    foreach($multiples as $base){
        if(($base > 0) && ($number - $base > 0)){
            if($number - (2 * $base ) > 0){
                $currentMultiples = range($base,($number - 1), $base);
            }else{
                $currentMultiples = [$base];
            }
            $baseMultiples = array_unique(array_merge($baseMultiples, $currentMultiples));
        }
    }
    return array_sum($baseMultiples);
}

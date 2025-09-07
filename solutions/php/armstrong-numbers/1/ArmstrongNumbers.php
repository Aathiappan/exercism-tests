<?php
declare(strict_types=1);

function isArmstrongNumber(int $number): bool
{
    $numberStr = (string) $number;
    $total = 0;
    for($i = 0; $i < strlen($numberStr);$i++){
        $total += pow((int) $numberStr[$i],strlen($numberStr));
    }
    return $total === $number;
}

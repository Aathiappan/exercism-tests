<?php

declare(strict_types=1);

function placeQueen(int $xCoordinate, int $yCoordinate): bool
{
    $error = null;
    if($xCoordinate < 0 || $yCoordinate < 0){
        $error = 'The rank and file numbers must be positive.';
    }else if($xCoordinate > 7 || $yCoordinate > 7){
        $error = 'The position must be on a standard size chess board.';
    }
    if($error){
        throw new InvalidArgumentException($error);
    }else{
        return true;
    }
}

function canAttack(array $whiteQueen, array $blackQueen): bool
{
    if(isSameFileOrRank($whiteQueen,$blackQueen)){
        return true;
    }
    if(isDiagonal($whiteQueen,$blackQueen)){
        return true;
    }
    return false;
}

function isSameFileOrRank(array $whiteQueen, array $blackQueen): bool
{
    return $whiteQueen[0] === $blackQueen[0] || $whiteQueen[1] === $blackQueen[1];
}
function isDiagonal(array $whiteQueen, array $blackQueen): bool
{
    $position = [1,1];
    if($whiteQueen[0] > $blackQueen[0]){
        $position[0] = -1;
    }
    if($whiteQueen[1] > $blackQueen[1]){
        $position[1] = -1;
    }
    $isdiagonal = false;
    while($whiteQueen[0] !== $blackQueen[0]){
        $whiteQueen[0] += $position[0];
        $whiteQueen[1] += $position[1];
    }
    return $whiteQueen[1] === $blackQueen[1];
}
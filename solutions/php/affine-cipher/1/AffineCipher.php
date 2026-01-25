<?php

declare(strict_types=1);


function encode(string $text, int $num1, int $num2): string
{
    for($m = 2; $m <= $num1; $m++){
        if((26 % $m === 0) && ($num1 % $m === 0)){
            throw new \Exception("encode with a not coprime to m");
            break;
        }
    }
    $alphabet = range('a','z');
    $strArr = str_split(strtolower(preg_replace('/[^a-zA-Z0-9]/','',$text)));
    $encodedStr = '';
    $j = 0;
    foreach($strArr as $char){
        if($j === 5){
            $encodedStr .= ' ';
            $j = 0;
        }
        if(in_array($char, $alphabet)){
            $i = array_search($char, $alphabet);
            $encodedStr .= $alphabet[((($num1 * $i) + $num2) % 26)];
        }else{
            $encodedStr .= $char;
        }
        $j++;
    }
    return $encodedStr;
}

function decode(string $text, int $num1, int $num2): string
{
    if($num1 < 1 || $num2 < 1){
        throw new InvalidArgumentException('bad input');
    }
    for($m = 2; $m <= $num1; $m++){
        if((26 % $m === 0) && ($num1 % $m === 0)){
            throw new \Exception("decode with a not coprime to m");
            break;
        }
    }
    $alphabet = range('a','z');
    $strArr = str_split(strtolower(preg_replace('/[^a-zA-Z0-9]/','',$text)));
    $encodedStr = '';
    foreach($strArr as $char){
        if(in_array($char, $alphabet)){
            $y = array_search($char, $alphabet);
            $mmi = getMMI($num1);
            $c = ($mmi * ($y - $num2)) % 26;
            $c = ($c >= 0) ? $c : $c + 26;
            $encodedStr .= $alphabet[$c];
        }else{
            $encodedStr .= $char;
        }
    }
    return $encodedStr;
}

function getMMI(int $number):int{
  $i = 1; $total;
  do{
    $total = (26 * $i) + 1;
    $i++;
  }while($total % $number !== 0);
  return $total / $number;
}

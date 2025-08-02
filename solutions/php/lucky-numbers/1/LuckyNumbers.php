<?php

class LuckyNumbers
{
    public function sumUp(array $digitsOfNumber1, array $digitsOfNumber2): int
    {
        //throw new \BadFunctionCallException("Implement the function");
        $nunStr1 = "";$nunStr2 = "";
        foreach($digitsOfNumber1 as $item1){
            $nunStr1 .= (string) $item1;
        }
        foreach($digitsOfNumber2 as $item2){
            $nunStr2 .= (string) $item2;
        }
        return (int)$nunStr1 + (int)$nunStr2;
    }

     function isPalindrome(int $number): bool
    {
        //throw new \BadFunctionCallException("Implement the function");
        $actNumb = $number;
        $tempNumb = 0;
        while($number != 0){
            $tempNumb = ($tempNumb * 10) + ($number % 10);
            $number = floor($number / 10);
        }
        return $tempNumb == $actNumb;
    }

    public function validate(string $input): string
    {
        //hrow new \BadFunctionCallException("Implement the function");
        if($input == ''){
            return 'Required field';
        }else if(!(is_numeric(trim($input)) && ((int)$input > 0) || (float)$input > 0)){
            return 'Must be a whole number larger than 0';
        }else{
            return '';
        }
    }
}

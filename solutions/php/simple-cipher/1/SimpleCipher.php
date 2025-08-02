<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class SimpleCipher
{
    public $key = "";
    private $chars = [];
    public function __construct(string $key = null)
    {
        $this->chars =range('a','z');
        if($key !== null){
            if($key == "" || $key == " " || !ctype_alpha($key) || !ctype_lower($key)){
                throw new InvalidArgumentException('Invalid Argument');
            }else{
                $this->key = $key;
            }
        }else{
            $newKey = "";
            foreach(range(1,100) as $i){
                $rind = array_rand($this->chars);
                $newKey .= $this->chars[$rind];
            }
            $this->key = $newKey;
        }
        //throw new BadFunctionCallException("Please implement the SimpleCipher class!");
    }

    public function encode(string $plainText): string
    {
        $inputStr = str_split($plainText);
        $cipher = str_split($this->key);
        $enText = "";
        for($i=0;$i < count($inputStr);$i++){
            $cind = array_search($cipher[$i],$this->chars);
            if($cind != 0){
                $iind = array_search($inputStr[$i],$this->chars);
                $nind = (($cind + $iind) > 25) ? ($cind + $iind) - 26 : ($cind + $iind);
                $enText .= $this->chars[$nind];
            }else{
                $enText .= $inputStr[$i];
            }
        }
        return $enText;
    }

    public function decode(string $cipherText): string
    {
        $inputStr = str_split($cipherText);
        echo $this->key;
        $cipher = str_split($this->key);
        $deText = "";
        for($i=0;$i < count($inputStr);$i++){
            $cind = array_search($cipher[$i],$this->chars);
            if($cind != 0){
                $iind = array_search($inputStr[$i],$this->chars);
                $nind = (($iind - $cind) >= 0) ? ($iind - $cind) : (26 + $iind - $cind);
                $deText .= $this->chars[$nind];
            }else{
                $deText .= $inputStr[$i];
            }
        }
        return $deText;
    }
}

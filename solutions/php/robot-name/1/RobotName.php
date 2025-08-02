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

class Robot
{
    private $name = '';
    public static $issued_names = [];
    public function getName(): string
    {
        //throw new \BadMethodCallException("Implement the getName method");
        if($this->name == ''){
            $this->name = '';
            while($this->name == ''){
                $str = $this->createName();
                if(!in_array($str,self::$issued_names)){
                    $this->name = $str;
                    array_push(self::$issued_names,$str);
                }
            }
        }
        
        echo $this->name;
        return $this->name;
    }

    public function reset(): void
    {
        //throw new \BadMethodCallException("Implement the reset method");
        $this->name = '';
    }
    private function createName():string
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $nums = "0123456789";
        $str = '';
        for($i=1;$i<6;$i++){
            if($i < 3){
                $str .= $chars[random_int(0,strlen($chars)-1)];
            }else{
                $str .= $nums[random_int(0,strlen($nums)-1)];
            }
        }
        return $str;
    }
}

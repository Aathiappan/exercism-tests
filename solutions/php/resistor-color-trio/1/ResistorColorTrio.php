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

class ResistorColorTrio
{
    public function label(array $input): string
    {
        //throw new \BadMethodCallException(sprintf('Implement the %s method', __FUNCTION__));
        if(count($input) < 3){
            throw new InvalidArgumentException("Invalid input length");
        }else{
            if(array_filter($input,'is_string') !== $input){
                throw new InvalidArgumentException("Invalid input");
            }else{
                $colval = ['black' => 0,'brown' => 1, 'red' => 2, 'orange' => 3, 'yellow' => 4,'green' => 5,'blue' => 6,'violet' => 7, 'grey' => 8, 'white' => 9];
                //unit found
                $flag = $input[1] === 'black' ? true : false;
                $flag1 = $input[0] === 'black' ? true : false;
                //echo $flag;
                if($input[2] !== 'black'){
                    $di = ($flag ? 1 : 0) + $colval[$input[2]];
                    $uname = 'ohm';
                    if($di > 2){
                        $divarr = $this->divider($di);
                        $tr = ($flag1 ? '' : (string) $colval[$input[0]]) . ($flag === false ? (string) $colval[$input[1]] : '');
                        return $tr.str_repeat('0',$divarr[1]).$divarr[0];
                    }else{
                        $tr = ($flag1 ? '' : (string) $colval[$input[0]]) . ($flag === false ? (string) $colval[$input[1]] : '');
                        //echo $di;
                        return $tr.str_repeat('0',$di).' ohms';
                    }
                }else{
                    return ($flag1 ? '' : (string) $colval[$input[0]]).($flag === false ? (string) $colval[$input[1]] : '0').' ohms';
                }
            }
        }
    }

    public function divider(int $val){
        $name = [' kiloohms',' megaohms',' gigaohms'];
        if($val % 3 === 0){
            $tname = ($val / 3) - 1;
            //echo $val;
            return [$name[$tname],0];
        }else{
            $tname = (int) ($val / 3);
            //echo $val;
            return [$name[$tname - 1],($val - ($tname * 3))];
        }
    }
}

<?php

declare(strict_types=1);

function flatten(array $input,array $result = []): array
{
    while(count($input) !== 0){
        $val = array_shift($input);
        if(is_array($val)){
           $result = [... flatten($val,$result)];
        }else{
            if($val !== null){
                $result[] = $val;
            }
        }
    }
    return $result;
}

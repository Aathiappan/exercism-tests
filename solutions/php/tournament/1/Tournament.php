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

class Tournament
{
    public function __construct()
    {
        //throw new BadFunctionCallException("Please implement the Tournament class!");
    }
    public function tally(string $scores):string
    {
        $scores = trim($scores);
        $paramArray = [];
        $resultStr = "Team                           | MP |  W |  D |  L |  P";
        if(empty($scores)){
            return $resultStr;
        }
        $scores = str_replace(["\r\n", "\r"], "\n", $scores);
        $lineArray = explode("\n",$scores);
        foreach($lineArray as $line){
            $params = explode(';',$line);
            array_push($paramArray,$params);
        }
        $result = [];
        foreach($paramArray as $match){
            if(strtolower($match[0]) == strtolower($match[1])){
                throw new InvalidArgumentException('Two team name are same exception');
            }
            if(count($match) != 3){
                throw new InvalidArgumentException(implode(';',$match));
            }
            foreach([$match[0],$match[1]] as $team){
                if(!array_key_exists($team,$result)){
                    $result[$team] = ["W"=>0,"L"=>0,"D"=>0,"P"=>0];
                }
            }
            if(strtolower($match[2]) == "win"){
                $result[$match[0]]["W"] = $result[$match[0]]["W"] + 1;
                $result[$match[0]]["P"] = $result[$match[0]]["P"] + 3;

                $result[$match[1]]["L"] = $result[$match[1]]["L"] + 1;
            }else if(strtolower($match[2]) == "draw"){
                $result[$match[0]]["D"] = $result[$match[0]]["D"] + 1;
                $result[$match[0]]["P"] = $result[$match[0]]["P"] + 1;

                $result[$match[1]]["D"] = $result[$match[1]]["D"] + 1;
                $result[$match[1]]["P"] = $result[$match[1]]["P"] + 1;
            }else if(strtolower($match[2]) == "loss"){
                $result[$match[0]]["L"] = $result[$match[0]]["L"] + 1;

                $result[$match[1]]["W"] = $result[$match[1]]["W"] + 1;
                $result[$match[1]]["P"] = $result[$match[1]]["P"] + 3;
            }
            
        }
        $keys = array_keys($result);

        // Convert associative array to indexed array
        $indexedArray = array_map(function($key, $value) {
            return ['key' => $key, 'value' => $value];
        }, $keys, $result);
        
        // Custom comparison function for usort
        usort($indexedArray, function($a, $b) {
            return $a['key'] <=> $b['key'];
        });
        usort($indexedArray, function($a, $b) {
            return $b['value']['P'] <=> $a['value']['P'];
        });
        $sortedData = array_combine(
            array_column($indexedArray, 'key'),
            array_column($indexedArray, 'value')
        );
        foreach($sortedData as $name => $teamscr){
            $mp = $teamscr["W"] + $teamscr["L"] + $teamscr["D"];
            $resultStr .= "\n".str_pad($name,31," ",STR_PAD_RIGHT)."|  ".str_pad((string)$mp,2," ",STR_PAD_RIGHT)."|  ".str_pad((string)$teamscr["W"],2," ",STR_PAD_RIGHT)."|  ".str_pad((string)$teamscr["D"],2," ",STR_PAD_RIGHT)."|  ".str_pad((string)$teamscr["L"],2," ",STR_PAD_RIGHT)."|  ".(string)$teamscr["P"];
        }
        return $resultStr;
    }
}

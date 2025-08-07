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

function winner(array $lines): ?string
{
    if(count($lines) === 1){
        if(strlen($lines[0]) === 1){
            if($lines[0] === 'X'){
				return 'black';
			}else if($lines[0] === 'O'){
				return 'white';
			}
        }else{
            return "not";
        }
    }
    $hex_status = [];
    array_map(function($item) use (&$hex_status){
        $hex_status[] = str_split($item);
    },$lines);
   
	$x_left = [];$x_right = [];$is_legal = true;
	for($i=0;$i<count($hex_status);$i++){
		if((count($hex_status[$i]) - $i) !== count($hex_status[0])){
			$is_legal = false;
		}
		if($hex_status[$i][$i] === 'X'){
			array_push($x_left,[$i,$i]);
		}
		if($hex_status[$i][count($hex_status[$i]) - 1] === 'X'){
			array_push($x_right,[$i,(count($hex_status[$i]) - 1)]);
		}
	}
	if(!$is_legal){
		return '';
	}
	if(!empty($x_left) && !empty($x_right) && hasPath($hex_status,'X',$x_left,$x_right)){
		return 'black';
	}
	$o_start = [];$o_end = [];
	if(array_search('O',$hex_status[0]) && array_search('O',$hex_status[count($hex_status) - 1])){
		$o_start = array_keys($hex_status[0],'O');
		$o_start = array_map(function($item){
			return [0, $item];
		},$o_start);
		$o_end = array_keys($hex_status[count($hex_status) - 1],'O');
		$endRow = count($hex_status) - 1;
		$o_end = array_map(function($item) use ($endRow){
			return [$endRow,$item];
		},$o_end);
		if(hasPath($hex_status,'O',$o_start,$o_end)){
			return 'white';
		}
	}
	if(empty($x_left) && empty($x_right) && empty($o_start) && empty($o_end)){
		return null;
	}
	return '';
}

function hasPath(array $board,string $player,array $startPoints,array $endPoints):bool{
	$moves = [[0, 2], [0, -2],[-1, 1],[-1,0],[-1, -1],[1, 1],[1,0],[1, -1]];
	$visited = [];
	foreach($startPoints as $start){
		if(dfs($board,$player,$start[0],$start[1],$endPoints,$visited,$moves)){
			return true;
		}
	}
	return false;
}
function dfs(array $board,string $player,int $row,int $col,array $endPoints,array &$visited,array $moves):bool{
	if(in_array([$row,$col],$endPoints)){
		return true;
	}
	$visited["{$row},{$col}"] = true;
	foreach($moves as $move){
		$newRow = $row + $move[0];
        $newCol = $col + $move[1];
		if(!isset($visited["{$newRow},{$newCol}"]) && isset($board[$newRow][$newCol]) && $board[$newRow][$newCol] === $player){
			if(dfs($board,$player,$newRow,$newCol,$endPoints,$visited,$moves)){
				return true;
			}
		}
	}
	return false;
}

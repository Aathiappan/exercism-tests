<?php
declare(strict_types=1);

function encode(string $plainMessage, int $rails): string
{
	$length = strlen($plainMessage);
	if($rails === 1|| $length < $rails){
		return $plainMessage;
	}
    $result = '';
	for($i = 0; $i < $rails; $i++){
		$j = $i;
		$flag = ($i === ($rails - 1));
		while($j < $length){
			$result.= $plainMessage[$j];
			if($flag){
				$next = 2 * ($i);
				$flag = ($i === ($rails - 1));
			}else{
				$next = (2 * ($rails - $i - 1));
				$flag = !($i === 0);
			}
			if($next === 0){
				break;
			}
			$j += $next;
		}
	}
	return $result;
}

function decode(string $cipherMessage, int $rails): string
{
    $length = strlen($cipherMessage);
	if($rails === 1|| $length < $rails){
		return $cipherMessage;
	}
	$is_unfilled = false;
	$column = (int) ceil(($length - 1) / ($rails - 1)) ;
	if(!(($length - 1) % ($rails - 1) === 0)){
		$is_unfilled = true;
	}
	if($column % 2 === 0){
		$topRowCnt = ($is_unfilled) ? $column / 2 : ($column / 2) + 1;
		$bottomRowCnt = $column / 2;
	}else{
		$topRowCnt = (int) ceil($column / 2);
		$bottomRowCnt = ($is_unfilled) ? $topRowCnt - 1 : $topRowCnt;
	}
	$topRow = str_split(substr($cipherMessage,0,$topRowCnt));
	$bottomRow = str_split(substr($cipherMessage,($length - $bottomRowCnt),$bottomRowCnt));
	$is_bottom = true;
	$result = array_shift($topRow);
	for($i=0;$i < $column;$i++){
		$tempStr = '';
		for($j=0;$j < ($rails - 2);$j++){
			$index = $topRowCnt + ($j * $column) + $i;
			$tempStr .= ($length > $index) ? $cipherMessage[$index] : '';
		}
		if($is_bottom){
			$result .= $tempStr;
			$result .= array_shift($bottomRow);
		}else{
			$result .= strrev($tempStr);
			$result .= array_shift($topRow);
		}
		$is_bottom = !$is_bottom;
	}
	return $result;
}
<?php

declare(strict_types=1);

function crypto_square(string $plaintext): string
{
    $normalized_text = strtolower(preg_replace('/[\p{P}\s]+/u','',$plaintext));
    if(strlen($normalized_text) > 2){
		$column = (int) ceil(sqrt(strlen($normalized_text)));
		$text_arr = str_split($normalized_text,$column);
		$text_arr = array_map(function($text) use ($column){
			return str_pad($text,$column,' ',STR_PAD_RIGHT);
		},$text_arr);
		$rows = count($text_arr);
		$result = '';
		for($j=0;$j < $column;$j++){
			$temp_str = '';
			for($i = 0; $i < $rows;$i++){
				$temp_str .= $text_arr[$i][$j];
			}
			$result .= ' '.$temp_str;
		}
		$result = ltrim($result);
		return $result;
    }else{
		return $normalized_text;
	}
}

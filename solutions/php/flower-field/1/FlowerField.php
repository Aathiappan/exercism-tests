<?php

declare(strict_types=1);

class FlowerField
{
    private $garden = [];
    public function __construct(array $garden)
    {
        $this->garden = $garden;
    }

    public function annotate(): array
    {
        if(empty($this->garden)){
			return $this->garden;
		}
		$gardenArr = [];
		array_walk($this->garden, function($item) use (&$gardenArr){
			$gardenArr[] = str_split($item);
		});
		$possible = [[-1,-1],[-1,0],[-1,1],[0,-1],[0,1],[1,-1],[1,0],[1,1]];
		for($i=0;$i < count($gardenArr);$i++){
			for($j = 0; $j < count($gardenArr[$i]); $j++)
			{
				if($gardenArr[$i][$j] === ' '){
					$flowerCount = 0;
					foreach($possible as $item){
						if(isset($gardenArr[$i + $item[0]][$j + $item[1]]) && $gardenArr[$i + $item[0]][$j + $item[1]] === '*'){
							$flowerCount++;
						}
					}
					$gardenArr[$i][$j] = ($flowerCount > 0) ? $flowerCount : ' ';
				}
			}
		}
		$result = [];
		array_walk($gardenArr, function($item) use (&$result){
			$result[] = implode('',$item);
		});
		return $result;
    }
}

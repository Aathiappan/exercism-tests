<?php

class HighSchoolSweetheart
{
    public function firstLetter(string $name): string
    {
        //throw new \BadFunctionCallException("Implement the function");
        $name = trim($name);
        return $name[0];
    }

    public function initial(string $name): string
    {
        //throw new \BadFunctionCallException("Implement the function");
        $fLetter = $this->firstLetter($name);
        return strtoupper($fLetter) . ".";
    }

    public function initials(string $name): string
    {
        //throw new \BadFunctionCallException("Implement the function");
        $strArr = explode(" ",$name);
        $finalInitial = "";
        $count = 0;
        foreach($strArr as $item){
            if($count > 0){
                $finalInitial .= " ";
            }
            $finalInitial .= $this->initial($item);
            $count += 1;
        }
        return $finalInitial;
    }

    public function pair(string $sweetheart_a, string $sweetheart_b): string
    {
        //throw new \BadFunctionCallException("Implement the function");
        $pair1 = $this->initials($sweetheart_a);
        $pair2 = $this->initials($sweetheart_b);

        /*$result = "";
        for($i = 3;$i>0;$i--){
        	$strsn = "";
        	$ssp = ($i *2) - 1;
        	$si = $ssp;
        	while($si>0){
        		$strsn .= " ";
        		$si--;
        	}
        	$strsn .= "**";
        	$sslsp = 7 - ($ssp + 2);
        	while($sslsp > 0){
        		$strsn .= " ";
        		$sslsp--;
        	}
        	$sfmid = 7 - $i;
        	$fmidspf = 0;
        	$fmidspl = 0;
        	$dmidstr = 0;
        	if($sfmid > 4){
        		$fmidspl = $i - 1;
        		$dmidstr = 2;
        		$fmidspf = $sfmid-1;
        	}else{
        		$fmidspl = $i;
        		$dmidstr = $sfmid;
        		$fmidspf = 0;
        	}
        	while($fmidspf > 0){
        		$strsn .= " ";
        		$fmidspf--;
        	}
        	while($dmidstr > 0){
        		$strsn .= "*";
        		$dmidstr--;
        	}while($fmidspl > 0){
        		$strsn .= " ";
        		$fmidspl--;
        	}
        	$strsn .= " ";
        	$sfmid = 7 - $i;
        	$fmidspf = 0;
        	$fmidspl = 0;
        	$dmidstr = 0;
        	if($sfmid > 4){
        		$fmidspf = $i - 1;
        		$dmidstr = 2;
        		$fmidspl = $sfmid-1;
        	}else{
        		$fmidspf = $i;
        		$dmidstr = $sfmid;
        		$fmidspl = 0;
        	}
        	while($fmidspf > 0){
        		$strsn .= " ";
        		$fmidspf--;
        	}
        	while($dmidstr > 0){
        		$strsn .= "*";
        		$dmidstr--;
        	}
        	while($fmidspl > 0){
        		$strsn .= " ";
        		$fmidspl--;
        	}
        	$si = (3 - $i) * 2;
        	while($si>0){
        		$strsn .= " ";
        		$si--;
        	}
        	$strsn .= "**";
        	$strsn .= PHP_EOL;
        	$result .= $strsn;
        }
        for($i = 2;$i > 0;$i--){
        	$strmn = "";
        	$fstrc = 2;
        	$fspc = 12;
        	$lstrc = 2;
        	$lspc = 12;
        	$mstrc = 0;
        	if($i == 2){
        		$mstrc = 1;
        	}
        	while($fstrc > 0){
        		$strmn .= "*";
        		$fstrc--;
        	}
        	while($fspc > 0){
        		$strmn .= " ";
        		$fspc--;
        	}
        	if($mstrc == 0){
        		$strmn .= " ";
        	}
        	while($mstrc > 0){
        		$strmn .= "*";
        		$mstrc--;
        	}
        	while($lspc > 0){
        		$strmn .= " ";
        		$lspc--;
        	}
        	while($lstrc > 0){
        		$strmn .= "*";
        		$lstrc--;
        	}
        	$strmn .= PHP_EOL;
        	$result .= $strmn;
        }
        $result .= "**     ".$pair1."  +  ".$pair2."     **".PHP_EOL;
        for($i=1;$i<9;$i++){
        	$space = ($i * 2) - 1;
        	if($i == 8){
        		$space = ($i * 2) - 2;
        	}
        	$strln = "";
        	for($j=1;$j<=$space;$j++){
        		$strln .= " ";
        	}
        	if($i == 8){
        		$strln .= "*".PHP_EOL;
        		$result .= $strln;
        		break;
        	}else{
        		$strln .= "**";
        	}
        	$fremsp = 15 - ($space + 2);
        	for($j=1;$j<=$fremsp;$j++){
        		$strln .= " ";
        	}
        	$eremsp = 14 - ((2 * $i) + 1);
        	if($eremsp > 0){
        		for($j=1;$j<=$eremsp;$j++){
        			$strln .= " ";
        		}
        	}
        	if($i < 7){
        		$strln .= "**";
        	}else if($i == 7){
        		$strln .= "*";
        	}
        	$strln .= PHP_EOL;
        	$result .= $strln;
        }*/
        $result = <<<EXPECTED_HEART
     ******       ******
   **      **   **      **
 **         ** **         **
**            *            **
**                         **
**     $pair1  +  $pair2     **
 **                       **
   **                   **
     **               **
       **           **
         **       **
           **   **
             ***
              *
EXPECTED_HEART;
        return $result;
    }
}

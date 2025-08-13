<?php
declare(strict_types=1);
const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
function meetup_day(int $year, int $month, string $which, string $weekday): DateTimeImmutable
{
    if($which !== 'teenth'){
		return new DateTimeImmutable("$which $weekday of $year-$month");
	}
        
    $firstTeenthDate =new DateTimeImmutable("$year-$month-13");
    $firstTeenthDayOrder = array_search(ucfirst($firstTeenthDate->format('l')),DAYS);
    $seekDayOrder = array_search(ucfirst($weekday),DAYS);
    if($firstTeenthDayOrder === $seekDayOrder){
        return $firstTeenthDate;
    }else if($firstTeenthDayOrder > $seekDayOrder){
        $dayOffset = 7 + $seekDayOrder - $firstTeenthDayOrder;
    }else{
        $dayOffset = $seekDayOrder - $firstTeenthDayOrder;
    }

    return $firstTeenthDate->modify("{$dayOffset} days");
	
}

<?php
declare(strict_types=1);

function meetup_day(int $year, int $month, string $which, string $weekday): DateTimeImmutable
{
    if($which !== 'teenth'){
		return new DateTimeImmutable("$which $weekday of $year-$month");
	}else{
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
		$firstTeenthDate =new DateTimeImmutable("$year-$month-13");
		$firstTeenthDayOrder = array_search(ucfirst($firstTeenthDate->format('l')),$days);
		$seekDayOrder = array_search(ucfirst($weekday),$days);
		if($firstTeenthDayOrder === $seekDayOrder){
			return $firstTeenthDate;
		}else if($firstTeenthDayOrder > $seekDayOrder){
			$dayOffset = 6 + 1 + $seekDayOrder - $firstTeenthDayOrder;
		}else{
			$dayOffset = $seekDayOrder - $firstTeenthDayOrder;
		}
        
		return $firstTeenthDate->modify("{$dayOffset} days");
	}
}

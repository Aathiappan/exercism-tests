<?php

declare(strict_types=1);

class SpaceAge
{
    public float $earthDays;
    public const TOTAL_EARTHDAYS = 365.25;
    public function __construct(int $seconds)
    {
        $this->earthDays = round($seconds / 86400,2);
    }

    public function earth(): float
    {
        return round($this->earthDays / self::TOTAL_EARTHDAYS, 2);
    }

    public function mercury(): float
    {
        return round($this->earth()  / 0.2408467, 2);
    }

    public function venus(): float
    {
        return round(($this->earth() / 0.61519726) , 2);
    }

    public function mars(): float
    {
        return round(($this->earth() / 1.8808158) , 2);
    }

    public function jupiter(): float
    {
        return round(($this->earth() / 11.862615) , 2);
    }

    public function saturn(): float
    {
        return round(($this->earth() / 29.447498) , 2);
    }

    public function uranus(): float
    {
        return round(($this->earth() / 84.016846) , 2);
    }

    public function neptune(): float
    {
        return round(($this->earth() / 164.79132) , 2);
    }
}

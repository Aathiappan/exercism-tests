<?php

class Address
{
    public string $street;
    public string $postal_code;
    public string $city;
    function __construct(string $strt,string $pcode,string $city){
        $this->$street = $strt;
        $this->$postal_code = $pcode;
        $this->$city = $city;
    }
}

<?php

class Person
{
    public $full_name;
    public $given_name;
    public $family_name;
    public $room = false;

    function get_info()
    {
        if ($this->full_name) {
            return $this->full_name;
        } elseif ($this->family_name && $this->given_name) {
            return $this->given_name . ' ' . $this->family_name;
        } else
            false;
    }
}

$chuck = new Person(null, null);
$chuck->full_name = "Chuck Severance";
$chuck->room = "3437NQ";
print $chuck->get_info() . "\n";


$colleen = new Person(null, null);
$colleen->family_name = 'van Lent';
$colleen->given_name = 'Colleen';
$colleen->room = '3439NQ';
print $colleen->get_info() . "\n";

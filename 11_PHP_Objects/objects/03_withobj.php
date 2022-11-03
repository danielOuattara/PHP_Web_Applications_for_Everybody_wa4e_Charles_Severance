<?php

class Person
{
    public $fullname;
    public $givenname;
    public $familyname;
    public $room;

    function get_name()
    {
        if ($this->fullname) return $this->fullname;
        if ($this->familyname && $this->givenname) {
            return $this->givenname . ' ' . $this->familyname;
        }
        return false;
    }
}

$chuck = new Person(null, null);
$chuck->fullname = "Chuck Severance";
$chuck->room = "3437NQ";
print $chuck->get_name() . "\n";


$colleen = new Person(null, null);
$colleen->familyname = 'van Lent';
$colleen->givenname = 'Colleen';
$colleen->room = '3439NQ';
print $colleen->get_name() . "\n";

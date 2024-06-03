<?php

class Hello
{
  protected ?string $lang;
  public $country;

  function __construct($lang = null, $country)
  {
    $this->lang = $lang;
    $this->country = $country;
  }

  function greet(?string $name = null): string
  {
    if ($this->lang == 'fr')
      return 'Bonjour' . ' ' . $name;
    if ($this->lang == 'es')
      return 'Hola' . ' ' . $name;
    return 'Hello Friend';
  }
}

class Social extends Hello
{
  public string $city;
  function __construct($lang = null, $country, $city)
  {
    parent::__construct($lang = null, $country);
    $this->city = $city;

  }
  function bye(?string $name = null): string
  {
    if ($this->lang == 'fr')
      return 'Au revoir' . $name;
    if ($this->lang == 'es')
      return 'Adios' . $name;
    return 'goodbye friend';
  }
}


$greeting = new Hello('es', 'spain', );
echo $greeting->greet('Garcia Meloni') . "\n";


echo ("----- \n");

$greeter = new Social('es', 'spain', 'Lisbon');
echo $greeter->greet('Garcia Meloni') . "\n";
echo $greeter->bye() . "\n";

echo ("------------------- \n");

$greeter_2 = new Social('null', 'fr', '234');
echo $greeter_2->greet() . "\n";
echo $greeter_2->bye() . "\n";

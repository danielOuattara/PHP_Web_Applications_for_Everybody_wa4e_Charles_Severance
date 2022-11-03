<?php

class Hello
{
  protected $lang;

  function __construct($lang)
  {
    $this->lang = $lang;
  }

  function greet()
  {
    if ($this->lang == 'fr') return 'Bonjour';
    if ($this->lang == 'es') return 'Hola';
    return 'Hello';
  }
}

$greetings = new Hello('es');
echo $greetings->greet() . "\n";

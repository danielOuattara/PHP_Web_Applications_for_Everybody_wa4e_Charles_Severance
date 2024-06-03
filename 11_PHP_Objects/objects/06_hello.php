<?php

class Hello
{
  # protected: only accessible and modifiable  in the class and subclasses 
  protected ?string $lang;

  function __construct($lang = null)
  {
    $this->lang = $lang;
  }

  function greet(?string $name = null)
  {
    if ($this->lang == 'fr')
      return 'Bonjour' . ' ' . $name;
    if ($this->lang == 'es')
      return 'Hola' . ' ' . $name;
    return 'Hello Friend';
  }
}

$greetings = new Hello('es');
echo $greetings->greet('Garcia') . "\n";
$greetings = new Hello('fr');
echo $greetings->greet('Antoine') . "\n";
$greetings = new Hello();
echo $greetings->greet('Mike') . "\n";

<?php


/* 

Sometimes a developer will prefer to make an object 
with public key-value pairs rather than an array.

Use where appropriate…

*/

$player = new stdClass();

$player->name = "Chuck";
$player->score = 12;

echo $player->score++, "\n";
print_r($player);


echo "-----------------------\n";

class Player
{
    public $name = "Sally";
    public $score = 0;
}

$p2 = new Player();
$p2->score++;

print_r($p2);

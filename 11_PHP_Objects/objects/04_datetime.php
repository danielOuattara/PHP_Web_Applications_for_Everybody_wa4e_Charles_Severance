<?php

date_default_timezone_set('America/New_York');

echo DateTime::RFC822 . "\n";

$x = new DateTime();
$y = new DateTime('now');
$z = new DateTime('2012-01-31');

echo $z->format('Y-m-d') . "\n";

$x = new DateTime('1999-04-31');
$oops = DateTime::getLastErrors();
print_r($oops);


$now = new DateTime();
$nextWeek = new DateTime('today +1 week');
echo 'Now:       ' . $now->format('Y-m-d') . "\n";
echo 'Next Week: ' . $nextWeek->format('Y-m-d') . "\n";

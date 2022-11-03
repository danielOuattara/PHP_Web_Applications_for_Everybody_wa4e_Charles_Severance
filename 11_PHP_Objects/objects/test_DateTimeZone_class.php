<?php

// date_default_timezone_set('Europe/Berlin');

echo DateTime::RFC822 . "\n\n";
$x = new DateTimeZone('Africa/Abidjan');
print_r($x->getLocation());


$tz = new DateTimeZone("Europe/Prague");
print_r($tz->getLocation());
print_r(timezone_location_get($tz));

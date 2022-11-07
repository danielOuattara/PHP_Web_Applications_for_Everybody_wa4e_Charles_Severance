<?php
sleep(2);

header('Content-Type: application/json; charset=utf-8');

$stuff = array(
  'first' => 'first thing',
  'second' => 'second thing'
);

$country = "Russia";

echo (json_encode($stuff));

// echo (json_encode($country));

// echo (json_encode([$stuff, $country]));

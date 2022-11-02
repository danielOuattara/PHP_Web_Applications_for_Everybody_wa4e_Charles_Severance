<?php

### Array functions


# array_key_exists

$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";

if (array_key_exists('course', $za)) {
    echo ("Course exists\n");
} else {
    echo ("Course does not exist\n");
}

echo "</br>\n", "</br>\n\n";


# isset

echo isset($za['name']) ? "name is set\n" : "name is not set\n";
echo "</br>\n", "</br>\n";

echo isset($za['addr']) ? "addr is set\n" : "addr is not set\n";

echo "</br>\n", "</br>\n";


# Null Coalesce

$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";

// PHP >= 7.0.0 only
$name = $za['name'] ?? 'not found';
$addr = $za['addr'] ?? 'not found';

echo "</br>\n", "</br>\n";


echo ("Name=$name\n");
echo ("Addr=$addr\n");

// PHP < 7.0.0 equivalent
$name = isset($za['name']) ? $za['name'] : 'not found';

echo "</br>\n", "</br>\n";


# Count 

$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
print "Count: " . count($za) . "\n";

echo "</br>\n", "</br>\n";

# is_array

if (is_array($za)) {
    echo '$za Is an array' . "\n";
} else {
    echo '$za Is not an array' . "\n";
}

echo "</br>\n", "</br>\n";

# order

$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
$za["topic"] = "PHP";
print_r($za);
sort($za);
print_r($za);

echo "</br>\n", "</br>\n";

# order 

$za = array();
$za["name"] = "Chuck";
$za["course"] = "WA4E";
$za["topic"] = "PHP";
print_r($za);
ksort($za);
print_r($za);
asort($za);
print_r($za);

echo "</br>\n", "</br>\n";


$inp = "This is a sentence with seven words";
$temp = explode(' ', $inp);
print_r($temp);

echo "</br>\n", "</br>\n";

$stuff = array(
    'course' => 'PHP-Intro',
    'topic' => 'Arrays'
);
echo isset($stuff['section']);

var_dump($stuff);
var_dump(23);
var_dump("Hello");


$sentence = "Lorem ipsum dolor sit amet consectetur adipisicing elit !";
$array_sentence = explode(' ', $sentence);
print_r($array_sentence);

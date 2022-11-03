<?php

date_default_timezone_set('Europe/Berlin');

// echo DateTime::RFC822 . "\n\n";

$x = new DateTime();

echo "ATOM = ", $x->format(DateTime::ATOM),  "\n";
echo "COOKIE = ", $x->format(DateTime::COOKIE),  "\n";
echo "ISO8601 = ", $x->format(DateTime::ISO8601),  "\n";
# echo "ISO8601_EXPANDED = ", $x->format(DateTime::ISO8601_EXPANDED),  "\n"; # ERROR ??
echo "RFC822 = ", $x->format(DateTime::RFC822),  "\n";
echo "RFC850 = ", $x->format(DateTime::RFC850),  "\n";
echo "RFC1036 = ", $x->format(DateTime::RFC1036),  "\n";
echo "RFC1123 = ", $x->format(DateTime::RFC1123),  "\n";
echo "RFC7231 = ", $x->format(DateTime::RFC7231),  "\n";
echo "RFC2822 = ", $x->format(DateTime::RFC2822),  "\n";
echo "RFC3339 = ", $x->format(DateTime::RFC3339),  "\n";
echo "RFC3339_EXTENDED = ", $x->format(DateTime::RFC3339_EXTENDED),  "\n";
echo "RSS = ", $x->format(DateTime::RSS),  "\n";
echo "W3C = ", $x->format(DateTime::W3C),  "\n";


echo $x->getOffset(), "\n";
echo $x->getTimestamp(), "\n";


// $y = new DateTime('now');
// $z = new DateTime('2012-01-31');

// echo $z->format(DateTime::ISO8601) . "\n";

// $x = new DateTime('1999-04-31');
// $oops = DateTime::getLastErrors();
// print_r($oops);

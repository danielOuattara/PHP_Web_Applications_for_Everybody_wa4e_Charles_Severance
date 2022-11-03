<?php

date_default_timezone_set('Europe/London');


# echo date(DATE_ATOM) , "\n";

$nextWeek = time() + (7 * 24 * 60 * 60);
echo 'Now:       ' . date('Y-m-d') . "\n";
echo 'Next Week: ' . date('Y-m-d', $nextWeek) . "\n";

echo ("=====\n");

$now = new DateTime();
$nextWeek = new DateTime('today +1 week');
echo 'Now:       ' . $now->format('Y-m-d') . "\n";
echo 'Next Week: ' . $nextWeek->format('Y-m-d') . "\n";

echo ("=====\n");

echo "Today is " . date("Y/m/d") . "\n";
echo "Today is " . date("Y.m.d") . "\n";
echo "Today is " . date("Y-m-d") . "\n";
echo "Today is " . date("d-m-Y-l, h:i:sa") . "\n";

echo mktime(0, null, null, null, null, 2099) , "\n";
echo mktime(0, null, null, null, null, 2100) , "\n";
echo mktime(0, null, null, null, null, 2101) , "\n";

echo mktime(0, null, null, null, null, 2102) - mktime(0, null, null, null, null, 2101) , "\n";


$d = mktime(00, 00, 01, 01, 01, 1970);
echo "\$d = " . $d . "\n";
echo "Created date is " . date("Y-m-d h:i:sa", $d) . "\n" ;
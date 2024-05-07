<?php

//------ call by value

$number_1 = 12;
echo $number_1, "\n";

function double($alias){
    $alias =  $alias * 2;
    return $alias;
}


$result_1 = double($number_1);
echo $result_1, "\n";
echo $number_1, "\n";

echo "-----------------------\n";
// call by reference

$number_2 = 9;
echo $number_2, "\n";

function triple(&$alias){
    $alias =  $alias * 3;
    return $alias;
}

$result_2 = triple($number_2);
echo $result_2, "\n";
echo $number_2, "\n";
<?php

$x = 3;
$txt = "0123456789";

while ($x < 7) {
    // echo $x, "<br />";
    for ($iter = 0; $iter < strlen($txt); $iter++) {
        echo $x, "<br />--------------------<br />";
        echo $iter, "<br />";
    }
    $x++;
}

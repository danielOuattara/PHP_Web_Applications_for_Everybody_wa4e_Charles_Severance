
    <?php
    $x = "15" + 27;
    echo ($x);
    echo "<br />";
    //-----------------------------------


    $x = 12;
    $y = 15 + $x++;
    echo "x is $x and y is $y \n";
    echo "<br />";
    //-----------------------------------


    $x = 12;
    $y = 15 + $x;
    $x = $x + 1;
    echo "x is $x and y is $y \n";
    echo "<br />";
    //-----------------------------------


    $a = 'Hello ' . 'World!';
    echo $a . "\n";
    echo "<br />";
    //-----------------------------------


    $www = 123;
    $msg = $www > 100 ? "Large" : "Small";
    echo "First: $msg \n";
    $msg = ($www % 2 == 0) ? "Even" : "Odd";
    echo "Second: $msg \n";
    $msg = ($www % 2) ? "Odd" : "Even";
    echo "Third: $msg \n";
    echo "<br />";
    //-----------------------------------


    $out = "Hello";
    $out = $out . " ";
    $out .= "World!";
    $out .= "\n";
    echo $out;
    $count = 0;
    $count += 1;
    echo "Count: $count\n";
    echo "<br />";
    //-----------------------------------


    $a = 56;
    $b = 12;
    $c = $a / $b;
    echo "C: $c\n";
    echo "<br />";

    $d = "100" + 36.25 + TRUE;
    echo "D: " . $d . "\n";
    echo "<br />";

    echo "D2: " . (string) $d . "\n";
    $e = (int) 9.9 - 1;
    echo "<br />";

    echo "E: $e\n";
    //$f = "sam" + 25;
    //echo "F: $f\n";
    $g = "sam" . 25;
    echo "G: $g\n";
    echo "<br />";
    //-----------------------------------


    if (123 == "123") print("Equality 1\n");
    echo "<br />";
    if (123 == "100" + 23) print("Equality 2\n");
    echo "<br />";
    if (FALSE == "0") print("Equality 3\n");
    echo "<br />";
    if ((5 < 6) == "2" - "1") print("Equality 4\n");
    echo "<br />";
    if ((5 < 6) === TRUE) print("Equality 5\n");
    echo "<br />";
    //-----------------------------------


    $vv = "Hello World!";
    echo "First:" . strpos($vv, "Wo") . "\n";
    echo "<br />";

    echo "Second: " . strpos($vv, "He") . "\n";
    echo "<br />";

    echo "Third: " . strpos($vv, "ZZ") . "\n";
    echo "<br />";

    if (strpos($vv, "He") == FALSE) echo "Wrong : 0 == FALSE\n";
    echo "<br />";

    if (strpos($vv, "He") === FALSE) echo "Good : 0 !== FALSE\n";
    echo "<br />";

    if (strpos($vv, "ZZ") == FALSE) echo "Right B\n";
    echo "<br />";

    if (strpos($vv, "He") !== FALSE) echo "Right C\n";
    echo "<br />";

    if (strpos($vv, "ZZ") === FALSE) echo "Right D\n";
    print_r(FALSE);
    print FALSE;
    echo "Where were they?\n";
    echo "<br />";
    //-----------------------------------

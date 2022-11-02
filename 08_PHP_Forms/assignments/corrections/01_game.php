<!DOCTYPE html>
<html>

<head>
    <title>daniel ouattara</title>
</head>

<body>
    <p>
        <?php
        //print_r($_GET);
        //print_r($_POST);
        $names = ["Rock", "Scissors", "Paper"];

        if (isset($_POST["logout"])) header("Location: ./../index.php");

        if (isset($_GET["name"])) echo ("Welcome " . $_GET["name"]);
        else die("Name parameter missing");

        function check($computer, $human)
        {
            $value = $computer - $human;
            if ($value == 0) {
                return ("Tie");
            } else if (($value == -1) || ($value == 2)) {
                return ("You lose");
            } else {
                return ("You win");
            }
        }
        ?>
    </p>

    <form method="post">
        <select name="human">
            <option value="-1">Select</option>
            <option value="0">Rock</option>
            <option value="1">Scissors</option>
            <option value="2">Paper</option>
            <option value="3">Test</option>
        </select>
        <input type="submit" value="Play" />
        <input type="submit" value="Logout" name="logout" />
    </form>
    <pre>
<?php
if (isset($_POST["human"])) {
    $computer = rand(0, 2);
    $human = $_POST["human"];
    if ($_POST["human"] == 3) {
        for ($c = 0; $c < 3; $c++) {
            for ($h = 0; $h < 3; $h++) {
                $r = check($c, $h);
                print "Your Play=$names[$h] Computer Play=$names[$c] Result=$r\n";
            }
        }
    } else if ($_POST["human"] == -1) {
        print "Please select a strategy and press Play.";
    } else {
        $r = check($computer, $human);
        print "Your Play=$names[$human] Computer Play=$names[$computer] Result=$r";
    }
}
?>
</pre>


</body>

</html>
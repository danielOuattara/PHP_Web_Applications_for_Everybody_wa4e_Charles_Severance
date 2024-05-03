<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daniel Ouattara MD5 Cracker</title>
</head>

<body>
    <h1>MD5 cracker</h1>
    <p>This application takes an MD5 hash
        of a two-character lower case string and
        attempts to hash all two-character combinations
        to determine the original two characters.</p>
    <pre>
Debug Output:
<?php

// for sequential print of the result
@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time', 120);

$goodText = "Not found";
$error = false;

// If there is no parameter, this code is all skipped
if (isset($_GET['md5'])) {

    $hash_to_crack = $_GET["md5"];
    if ($hash_to_crack) {
        $time_start = microtime(true);
        $md5 = $_GET['md5'];

        // This is our alphabet
        // $txt = "0123456789"; # case for number only
        // $txt = "abcdefghijklmnopqrstuvwxyz"; # case for lower letter case ;
        $txt = "abcdefghijklmnopqrstuvwxyz0123456789"; # case for numbers and letter lower case ;
        // $txt = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ,;:!?./§ù*%µ^\$¨£&é\"'(-è_çà)=~#{[|`\^@]}"; # case for more chars
        $txt = str_shuffle($txt);
        $show = 15;

        for ($iteration_1 = 0; $iteration_1 < strlen($txt); $iteration_1++) {
            $char_1 = $txt[$iteration_1];

            for ($iteration_2 = 0; $iteration_2 < strlen($txt); $iteration_2++) {
                $char_2 = $txt[$iteration_2];

                for ($iteration_3 = 0; $iteration_3 < strlen($txt); $iteration_3++) {
                    $char_3 = $txt[$iteration_3];

                    for ($iteration_4 = 0; $iteration_4 < strlen($txt); $iteration_4++) {
                        $char_4 = $txt[$iteration_4];

                        $try = $char_1 . $char_2 . $char_3 . $char_4;
                        $try_md5 = hash('md5', $try);
                        if ($try_md5 === $md5) {
                            $goodText = $try;
                            break;
                        }

                        # Debug output until $show hits 0
                        // if ($show > 0) {
                        //     $show = $show - 1;
                        //     print "$try_md5 $try\n";
                        //     if (usleep(200000) != 0) {
                        //         echo "sleep failed script terminating";
                        //         break;
                        //     }
                        //     flush();
                        //     ob_flush();
                        // }
                    }
                }
            }
        }
        # Compute elapsed time
        $time_end = microtime(true);
        print "Elapsed time: ";
        print $time_end - $time_start;
        print "\n";
    } else {
        $error = "ERROR: Please provide a hash value to be cracked ";
    }
}
?>

</pre>
    <!-- Use the very short syntax and call htmlentities() -->
    <p>Original PIN: <?= htmlentities($goodText); ?></p>
    <?php
    if ($error) {
        print '<p style="color:red">';
        print htmlentities($error);
        print "</p>\n";
    }
    ?>
    <form>
        <input type="text" name="md5" size="60" value="<?= htmlentities($_GET['md5'] ?? '') ?>" />
        <input type="submit" value="Crack MD5" />
    </form>
    <ul>
        <li><a href="index.php">Reset</a></li>
        <li><a href="md5.php">MD5 Encoder</a></li>
        <li><a href="makecode.php">MD5 Code Maker</a></li>
        <li><a href="https://github.com/csev/wa4e/tree/master/code/crack" target="_blank">Source code for this application</a></li>
    </ul>
</body>

</html>
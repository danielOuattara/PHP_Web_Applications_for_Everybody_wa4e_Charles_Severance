<?php
@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time', 120);

for ($i = 0; $i < 11; $i++) {
    echo $i . "<br />";

    if (sleep(1) != 0) {
        echo "sleep failed script terminating";
        break;
    }
    flush();
    ob_flush();
}

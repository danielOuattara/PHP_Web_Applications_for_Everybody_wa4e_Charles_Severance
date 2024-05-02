<?php

$stuff = array("Hi", "There");
echo $stuff[1], "</br>\n";


$stuff = array(
    "name" => "Chuck",
    "course" => "WA4E"
);
echo $stuff["course"], "</br>";

print_r($stuff);
echo ("\n</br>\n");

echo ("<pre>\n");
print_r($stuff);
echo ("\n</pre>\n");

var_dump($stuff);
echo "</br>", "</br>";

$thing = FALSE;
echo ("One\n");
print_r($thing);
echo ("Two\n");
var_dump($thing);
echo "</br>", "</br>";


$va = array();
$va[] = "Hello";
$va[] = "World";
print_r($va);
echo "</br>", "</br>";

//--------------------

$stuff = array(
    "name" => "Chuck",
    "course" => "SI664"
);

foreach ($stuff as $k => $v) {
    echo "Key=", $k, " Val=", $v, ",\n";
}
echo "</br>", "</br>";

//-----
$stuff = array("Chuck", "SI664");

foreach ($stuff as $k => $v) {
    echo "Key=", $k, " Val=", $v, ",\n";
}
echo "</br>", "</br>";

//-----
$stuff = array("Chuck", "SI664");

for ($i = 0; $i < count($stuff); $i++) {
    echo "i=", $i, " value=", $stuff[$i], ", \n";
}
echo "</br>", "</br>";

//-----

$products = array(
    'paper' =>    array(
        'copier' => "Copier & Multipurpose",
        'inkjet' => "Inkjet Printer",
        'laser' => "Laser Printer",
        'photo' => "Photographic Paper"
    ),
    'pens' => array(
        'ball'    => "Ball Point",
        'hilite' => "Highlighters",
        'marker' => "Markers"
    ),
    'misc' => array(
        'tape'    => "Sticky Tape",
        'glue'    => "Adhesives",
        'clips' => "Paperclips"
    )
);


echo $products["pens"]["marker"];
echo "</br>", "</br>";

var_dump($products);
echo "</br>", "</br>";

print_r($products);
echo "</br>", "</br>";


echo ("<pre>\n");
print_r($products);
echo ("\n</pre>\n");

<?php

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is meow123

$pass = "php123";
$check = hash('md5', $salt . $pass);

echo
"stored_hash = ", $stored_hash, "\n",
"pass_hash = ", $check, "\n";

if ($check === $stored_hash) echo "Victory !";

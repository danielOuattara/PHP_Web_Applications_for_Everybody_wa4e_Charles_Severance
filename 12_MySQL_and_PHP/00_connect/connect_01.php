<?php

/** 
 * Simply connect to DB and fetch all users.
 * No While loop in printing results 
 */

$pdo = new PDO(
    $dsn = 'mysql:host=localhost;port=3306;dbname=wa4e_misc',
    $username = 'root',
    $password = ''
);

$stmt = $pdo->query("SELECT * FROM users");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>\n";
print_r($rows);
echo "</pre>\n";


echo ("----------------------------------------------- \n");

/** 
 * Simply connect to DB and fetch all users.
 * Using While loop in printing results 
 * 
 */


$pdo = new PDO(
    $dsn = 'mysql:host=localhost;port=3306;dbname=wa4e_misc',
    $username = 'root',
    $password = ''
);

$stmt = $pdo->query("SELECT * FROM users");

echo "<pre>\n";
while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    print_r($row);
};
echo "</pre>\n";

$pdo = null;
<?php

/**
 * Syntax error here, PDO mode is ERRMODE_EXCEPTION (Fatal Error)
 * But try...cath block is used to handle any error as desired
 */

require_once "./../pdo.php";

// GET Parameter 
$_GET['user_id'] = 3;

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
    $stmt->execute(array(":pizza" => $_GET['user_id']));
} catch (Exception $ex) {
    echo ("ERROR - " . $ex->getMessage());
    return; // <--- notice return to quit in case of error
    // return OR exit() OR die()
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    echo ("<p>user_id not found</p>\n");
} else {
    echo ("<p>user_id found</p>\n");
}

<?php

/**
 * Syntax error here, PDO mode is ERRMODE_EXCEPTION (Fatal Error)
 * But try...cath block is used to any error as desired.
 * Here we send a custom message and log error using 'err_log()'
 * function
 */

require_once "./../pdo.php";

// GET Parameter 

$_GET['user_id'] = 3;

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
    $stmt->execute(array(":pizza" => $_GET['user_id']));
} catch (Exception $err) {
    echo ("Internal error, please contact support");
    error_log("error4.php, SQL error=" . $err->getMessage());
    return;
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    echo ("<p>user_id not found</p>\n");
} else {
    echo ("<p>user_id found</p>\n");
}

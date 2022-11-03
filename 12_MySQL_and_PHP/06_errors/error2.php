<?php

/**
 * Syntax error here (line 15, pizza not good, study case), 
 * andPDO mode is ERRMODE_EXCEPTION (Fatal Error)
 */

require_once "./../pdo.php";

// GET Parameter 
$_GET['user_id'] = 3;

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
$stmt->execute(array(":pizza" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    echo ("<p>user_id not found</p>\n");
} else {
    echo ("<p>user_id found</p>\n");
}

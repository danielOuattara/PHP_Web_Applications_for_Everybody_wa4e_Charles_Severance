<?php

/**
 * Here result of the query is id / found / id not found
 */

require_once "./../pdo.php";

// GET Parameter
# $_GET['user_id'] = 3;
# $_GET['user_id'] = 5;

if (!isset($_GET['user_id'])) die('GET parameter required');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$stmt = $pdo->prepare("SELECT * FROM users where user_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    echo ("<p>user_id not found</p>\n");
} else {
    echo ("<p>user_id found</p>\n");
}
